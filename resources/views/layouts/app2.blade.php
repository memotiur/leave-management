<!DOCTYPE html>
<html lang="en">
<head>
    @include('includes.head')
</head>
<body>

<section class="wrapper">

    @include('includes.top_bar')

    @include('includes.sidebar')


    <section>

        <section class="main-content">
            @yield('content')
        </section>

    </section>

</section>


@include('includes.footer2')

</body>
</html>