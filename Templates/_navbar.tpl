<nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm mb-3">
    <div class="container">
        <a class="navbar-brand" href="/">
            Задачник
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label='Toggle navigation'>
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                {set $pages = $_controller->getMenu()}
                {foreach $pages as $name => $page}
                    {if $_controller->name == $name}
                        <li class="nav-item">
                            <a href="#" style="cursor: default;" class="nav-link"
                               onclick="return false;">{$page.title}</a>
                        </li>
                    {else}
                        <li class="nav-item"><a class="nav-link" href="{$page.link}">{$page.title}</a></li>
                    {/if}
                {/foreach}
            </ul>
        </div>

        <ul class="navbar-nav ml-auto">
            <!-- Authentication Links -->
            {if $admin==false}
                <li class="nav-item">
                    <a class="nav-link" href="/loginform/">Login</a>
                </li>
            {else}
                <li class="nav-item dropdown">
                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                       data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                        Admin <span class="caret"></span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="/logout/"
                           onclick="event.preventDefault(); document.getElementById('logout-form').submit();">'Logout'
                        </a>
                        <form id="logout-form" action="/logout/" method="POST"
                              style="display: none;">
                        </form>
                    </div>
                </li>
            {/if}
        </ul>
    </div>
</nav>