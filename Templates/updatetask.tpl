{extends '_base.tpl'}

{block 'title'}
    {$title} / {parent}
{/block}

{block 'content'}
    {if $item}
        <div id="news-wrapper">
            <div class="card mb-2">
                <div class="card-header">{$item.username} - {$item.email}
                </div>
                <div class="card-body">
                    <div class="card-text">
                        {autoescape  true}
                        {$item.tasktext}
                        {/autoescape}
                    </div>
                </div>
            </div>
        </div>
    {/if}

    <div id="">
        <h4>Обновить задачу</h4>
        <div class="row">
            <div class="col">
                <form method="post" action="/task/update">
                    <input type="hidden" name="id" value="{$item.id}">
                    <div class="form-group">
                        <fieldset class="border" id="group1">
                            <div>Выбрать статус</div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="status" id="" value="0">
                                <label class="form-check-label">Новая задача</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="status" id="" value="1" checked>
                                <label class="form-check-label">Изменена админом</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="status" id="" value="2">
                                <label class="form-check-label">Задача выполнена</label>
                            </div>
                        </fieldset>
                    </div>
                    <div class="form-group">
                        <label for="name">Username</label>
                        <input type="text" class="form-control" id="name" name="username"
                               placeholder="Username" value="{$item.username}">
                    </div>
                    <div class="form-group">
                        <label for="email">E-mail</label>
                        <input type="text" class="form-control" id="email" name="email"
                               placeholder="E-Mail" value="{$item.email}">
                    </div>
                    <div class="form-group">
                        <label for="content">Текст задачи</label>
                        <textarea class="form-control" id="tasktext" name="tasktext" placeholder="Your Text">{$item.tasktext}
                        </textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Обновить</button>
                </form>
            </div>
        </div>
    </div>
{/block}