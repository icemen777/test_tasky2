<div id="{$message=='' ? 'addtaskform' : 'openedtaskform'}">
    <h4>Форма добавления задачи</h4>
    <div class="row">
        <div class="col">
            <form method="post" action="/tasks/maketask">
                <div class="form-group">
                    <label for="name">Username</label>
                    <input type="text" class="form-control" id="name" name="username"
                           placeholder="Username" value="">
                </div>
                <div class="form-group">
                    <label for="email">E-mail</label>
                    <input type="text" class="form-control" id="email" name="email"
                           placeholder="E-Mail" value="">
                </div>
                <div class="form-group">
                    <label for="content">Текст задачи</label>
                    <textarea class="form-control" id="tasktext" name="tasktext"
                              placeholder="Your Text"></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Отправить</button>
            </form>
        </div>
    </div>
</div>