@if($kom->parent_komponen == null)
<div class="card card-body mb-1">
    <h5 class="card-title">{{ $kom['komponen'] }}</h5>
    @if(count($kom->indikator) > 0)
    <a href="{{route('admin.komponen.show', $kom['id_komponen'])}}">Lihat detail</a>
    @else
    <a class="text-danger" href="{{route('admin.komponen.show', $kom['id_komponen'])}}">Lihat detail</a>
    @endif
    <hr>

    @if (count($kom['children']) > 0)
        <ol>@each('rec-item', $kom['children'], 'kom')</ol>
    @endif
</div>

@elseif($kom->parent['parent_komponen'] == null)
    @if (count($kom['children']) > 0 )
        @if (count($kom['indikator']) > 0)
        <li><a href="{{route('admin.komponen.show', $kom['id_komponen'])}}">{{ $kom['komponen'] }}</a></li>
        @else
        <li><a class="text-danger" href="{{route('admin.komponen.show', $kom['id_komponen'])}}">{{ $kom['komponen'] }}</a></li>
        @endif
        <ol>@each('rec-item', $kom['children'], 'kom')</ol>
    @else
        @if (count($kom['indikator']) > 0)
        <li><a href="{{route('admin.komponen.show', $kom['id_komponen'])}}">{{ $kom['komponen'] }}</a></li>
        @else
        <li><a class="text-danger" href="{{route('admin.komponen.show', $kom['id_komponen'])}}">{{ $kom['komponen'] }}</a></li>
        @endif
    @endif
    <hr>
@else
    @if (count($kom['children']) > 0 )
        @if (count($kom['indikator']) > 0)
        <li><a href="{{route('admin.komponen.show', $kom['id_komponen'])}}">{{ $kom['komponen'] }}</a></li>
        @else
        <li><a class="text-danger" href="{{route('admin.komponen.show', $kom['id_komponen'])}}">{{ $kom['komponen'] }}</a></li>
        @endif
        <ol>@each('rec-item', $kom['children'], 'kom')</ol>
    @else
        @if (count($kom['indikator']) > 0)
        <li><a href="{{route('admin.komponen.show', $kom['id_komponen'])}}">{{ $kom['komponen'] }}</a></li>
        @else
        <li><a class="text-danger" href="{{route('admin.komponen.show', $kom['id_komponen'])}}">{{ $kom['komponen'] }}</a></li>
        @endif
    @endif

@endif