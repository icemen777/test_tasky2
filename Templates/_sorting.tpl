{var $active = $.php.Core.View::makeactivelink($sorting)}
<div class="row mb-3">
    <div class="col-auto">
        Sorting by
    </div>
    <div class="col-auto">
        <div class="form-check-label">user</div>
        <form action="/tasks" class="arrowbut" method="get">
            <input type="hidden" name="sorting" value="username">
            <input type="hidden" name="sortcurs" value="ASC">
            <button type="submit" class="btn {($active[0]=='username' && $active[1]=='ASC') ? 'btn-danger' : 'btn-success' }"><span class="glyphicon glyphicon-chevron-up"></span></button>
        </form>
        <form action="/tasks" class="arrowbut" method="get">
            <input type="hidden" name="sorting" value="username">
            <input type="hidden" name="sortcurs" value="DESC">
            <button type="submit" class="btn {($active[0]=='username' && $active[1]=='DESC') ? 'btn-danger' : 'btn-success' }"><span class="glyphicon glyphicon-chevron-down"></span></button>
        </form>
    </div>
    <div class="col-auto">
        <div class="form-check-label">email</div>
        <form action="/tasks" class="arrowbut" method="get">
            <input type="hidden" name="sorting" value="email">
            <input type="hidden" name="sortcurs" value="ASC">
            <button type="submit" class="btn {($active[0]=='email' && $active[1]=='ASC') ? 'btn-danger' : 'btn-success' }"><span class="glyphicon glyphicon-chevron-up"></span></button>
        </form>
        <form action="/tasks" class="arrowbut" method="get">
            <input type="hidden" name="sorting" value="email">
            <input type="hidden" name="sortcurs" value="DESC">
            <button type="submit" class="btn {($active[0]=='email' && $active[1]=='DESC') ? 'btn-danger' : 'btn-success' }"><span class="glyphicon glyphicon-chevron-down"></span></button>
        </form>
    </div>
    <div class="col-auto">
        <div class="form-check-label">status</div>
        <form action="/tasks" class="arrowbut" method="get">
            <input type="hidden" name="sorting" value="status">
            <input type="hidden" name="sortcurs" value="ASC">
            <button type="submit" class="btn {($active[0]=='status' && $active[1]=='ASC') ? 'btn-danger' : 'btn-success' }"><span class="glyphicon glyphicon-chevron-up"></span></button>
        </form>
        <form action="/tasks" class="arrowbut" method="get">
            <input type="hidden" name="sorting" value="status">
            <input type="hidden" name="sortcurs" value="DESC">
            <button type="submit" class="btn {($active[0]=='status' && $active[1]=='DESC') ? 'btn-danger' : 'btn-success' }"><span class="glyphicon glyphicon-chevron-down"></span></button>
        </form>
    </div>
    <div class="col">
        <form action="" class="" id="{$message=='' ? 'addtask_button' : 'hide_addtask_button'}" method="get">
            <input type="hidden" name="addtask" value="on">
            <button type="submit" class="btn btn-info">Добавить задачу</button>
        </form>
    </div>
</div>