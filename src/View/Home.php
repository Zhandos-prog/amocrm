<?php

namespace App\View;

Class Home {

    public function render()
    {
        ?>
            <!doctype html>
            <html lang="en">
            <head>
                <meta charset="utf-8">
                <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

                <link rel="stylesheet" href="assets\css\bootstrap.min.css">

                <title>Amo CRM</title>
            </head>
            <body>
                <div class="container">
                <form action="/create-task" method="post">
                    <div class="text-center">
                        <h2>Добавьте задачу</h2>
                    </div>
                    
                    <div class="form-group">
                        <label for="name">Название задачи:</label>
                        <input type="text" class="form-control" id="name" name="name" required>
                    </div>
                    <div class="form-group">
                        <label for="type">Выберите тип:</label>
                        <select class="form-control" id="type" name="type" required>
                        <option value="1">Звонок</option>
                        <option value="2">Встреча</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="date">Укажите дату:</label>
                        <input type="date" name="date" id="date" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Отправить</button>
                </form>
                </div>
                
            </body>
            </html>

        <?php
    }
}