@php
    $menus = array(
    /**
    * Ini Untuk Sidebar superadmin
    */
    [
        'name' => 'Main FIture',
        'type' => 'title', // single, multi, title
        'role' => 'superadmin'
    ],
    [
        'name' => 'Daftar Barang',
        'url' => '/superadmin/barang',
        'icon' => 'server',
        'type' => 'single', // single, multi, title
        'role' => 'superadmin'
    ],
    [
        'name' => 'Management User',
        'url' => '/superadmin/management-users',
        'icon' => 'users',
        'type' => 'single', // single, multi, title
        'role' => 'superadmin'
    ],
    [
        'name' => 'Kategori Management',
        'url' => '/superadmin/kategori',
        'icon' => 'hard-drive',
        'type' => 'single', // single, multi, title
        'role' => 'superadmin'
    ]
);

@endphp
<ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
@foreach($menus as $menu)

    @php
        //dd($menu['type']);

    @endphp
    @if($menu['type'] == 'single')

       <li class="{{'/'.Request::path() == $menu['url'] ? 'active' : ''}} nav-item"><a class="d-flex align-items-center" href="{{$menu['url']}}"><i data-feather="{{$menu['icon']}}"></i><span class="menu-title text-truncate" data-i18n="Email">{{$menu['name']}}</span></a></li>
    @elseif($menu['type'] == 'multi')
            @php
                $temp = [];
                    foreach ($menu['items'] as $i){
                        array_push($temp, $i['url']);
                    }
            @endphp
        <li class=" nav-item"><a class="d-flex align-items-center" href="#"><i data-feather="{{$menu['icon']}}"></i><span class="menu-title text-truncate" data-i18n="Dashboards">{{$menu['name']}}</span><span class="badge badge-light-warning rounded-pill ms-auto me-1">2</span></a>
            <ul class=" menu-content">
                @foreach($menu['items'] as $item)
                    <li class="{{in_array('/'.Request::path(),$temp) ? 'active' : ''}}"><a class="d-flex align-items-center" href="{{$item['url']}}"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="Analytics">{{$item['name']}}</span></a></li>
                @endforeach
            </ul>
        </li>
    @elseif($menu['type'] == 'title')
       <li class=" navigation-header"><span data-i18n="Apps &amp; Pages">{{$menu['name']}}</span><i data-feather="more-horizontal"></i></li>
    @endif
@endforeach
</ul>

{{--    <li class=" navigation-header"><span data-i18n="Apps &amp; Pages">Apps &amp; Pages</span><i data-feather="more-horizontal"></i></li>--}}
{{--    <li class=" nav-item"><a class="d-flex align-items-center" href="app-email.html"><i data-feather="mail"></i><span class="menu-title text-truncate" data-i18n="Email">Email</span></a></li>--}}

