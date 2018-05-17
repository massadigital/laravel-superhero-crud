    <header class="main-header">
        <div class="container">
            <h1>
            {{ $slot }}             
            </h1>
            @if($extra!='')
            {{ $extra }}
            @endif
        </div>
    </header>
