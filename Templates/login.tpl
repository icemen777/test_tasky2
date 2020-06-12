{extends '_base.tpl'}

{block 'title'}
    {$title} / {parent}
{/block}

{block 'content'}
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Login -
                        <span class="alert-danger">admin / 123</span></div>

                    <div class="card-body">
                        <form method="POST" action="/login/">

                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label text-md-right">Login</label>

                                <div class="col-md-6">
                                    <input id="name" type="name" class="form-control" name="user"
                                           value="" required autofocus>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password" class="col-md-4 col-form-label text-md-right">Password</label>
                                <div class="col-md-6">
                                    <input id="password" type="password" class="form-control" name="password" required>
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-8 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        Login
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
{/block}