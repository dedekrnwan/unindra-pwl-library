<?php

namespace App\Usecase;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Date;
use App\Models\Book as BookModel;
use App\Models\BookTurnover as BookTurnoverModel;

class UserLoan extends Base implements IBase
{
    private Book $bookUsecase;
    private BookTurnover $bookTurnoverUsecase;
    public function __construct(Model $model)
    {
        parent::__construct($model);

        $this->bookUsecase = new Book(new BookModel());
        $this->bookTurnoverUsecase = new BookTurnover(new BookTurnoverModel());
    }
    public function find() : Collection{
        try {
            $data = $this->model->newQuery()->with("user", "book", "book_turnover")->orderBy("created_at", 'desc')->get();
            return $data;
        } catch (\Exception $e) {
            throw $e;
        }
    }

    public function create(array $payload): Model
    {
        try {
            if (Date::createFromFormat('d-m-Y', $payload['effective_date']) &&
                Date::createFromFormat('d-m-Y', $payload['expired_date'])
            ) {
                $payload['effective_date'] = Date::createFromFormat('d-m-Y', $payload['effective_date'])->toDate();
                $payload['expired_date'] = Date::createFromFormat('d-m-Y', $payload['expired_date'])->toDate();
            } else {
                throw new \Exception("Can't parse effective_date & expired_date to d-m-Y format");
            }

            $book = $this->bookUsecase->findOne($payload['book_id']);

            if ($book['stock'] <= 0) {
                throw new \Exception("Book stock not enought");
            }

            //user cant load same book in same period
            if ($this->model->newQuery()
                ->where("book_id", $payload['book_id'])
                ->where("user_id", $payload['user_id'])
                ->where("expired_date", ">=", Date::parse($payload['expired_date'])->setHour(0)->setMinutes(0)->setSeconds(0)->toDateTime())
                ->where("status", 'borrowed')
                ->exists()
            ) {
                throw new \Exception("You can't borrow same book in same period");
            }

            //update book
            $this->bookUsecase->update($payload['book_id'], [
                'stock' => $book['stock']-$payload['quantity']
            ]);

            $payload['status'] = 'borrowed';

            $data = $this->model->newQuery()->create($payload);
            return $data;
        } catch (\Exception $e) {
            throw $e;
        }
    }

    public function update(int $id, array $payload): Model
    {
        try {
            $data = $this->model->newQuery()->where("status", "borrowed")->findOrFail($id);

            if (array_key_exists('status',$payload)) {
                $book = $this->bookUsecase->findOne($data['book_id']);
                //status conditional
                switch ($payload['status']) {
                    case 'returned':
                        //update book qty
                        $this->bookUsecase->update($data['book_id'], [
                            'stock' => $book['stock']+$data['quantity'],
                        ]);

                        $this->model->newQuery()
                            ->where("id", $data['id'])
                            ->update([
                                'return_date' => Date::now(),
                            ]);
                    case 'lost':
                        //insert book turnover
                        $this->bookTurnoverUsecase->create([
                            'book_id' => $data['book_id'],
                            'user_id' => $data['user_id'],
                            'user_loan_id' => $data['id'],
                            'cash_amount' => $book['price'],
                            'quantity' => $data['quantity'],
                        ]);
                        //update book qty
                        $this->bookUsecase->update($data['book_id'], [
                            'stock' => $book['stock']+$data['quantity'],
                        ]);

                        $this->model->newQuery()
                            ->where("id", $data['id'])
                            ->update([
                                'return_date' => Date::now(),
                            ]);
                }
            }

            $data->update($payload);
            return $data;
        } catch (\Exception $e) {
            throw $e;
        }
    }
}
