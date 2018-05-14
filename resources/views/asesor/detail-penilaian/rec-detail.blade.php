<!-- Komponen Utama -->
@if($kom->parent_komponen == null)
<div class="card card-body mb-1">
    <h5 class="card-title">{{ $kom['komponen'] }}</h5>
    
    <hr>

    @if (count($kom['children']) > 0)
        <ol>@each('asesor.detail-penilaian.rec-detail', $kom['children'], 'kom')</ol>
    @else
        <input type="hidden" name="id_komponen[]" value="{{$kom['id_komponen']}}">
        <input type="number" name="skor[]" step="any" min="0" max="10">

    @endif
</div>

<!-- Komponen Kedua -->
@elseif($kom->parent['parent_komponen'] == null)
    <li>{{ $kom['komponen'] }}</li>

    @if (count($kom['children']) > 0 )
    
    <ol>@each('asesor.detail-penilaian.rec-detail', $kom['children'], 'kom')</ol>

    @else
        <input type="hidden" name="id_komponen[]" value="{{$kom['id_komponen']}}">
        <input type="number" name="skor[]" step="any" min="0" max="10">
    
    @endif
    <hr>

<!-- Komponen turunan lainnya -->
@else
    <li>{{ $kom['komponen'] }}</li>

    @if (count($kom['children']) > 0 )

    <ol>@each('asesor.detail-penilaian.rec-detail', $kom['children'], 'kom')</ol>    

    @else
        <input type="hidden" name="id_komponen[]" value="{{$kom['id_komponen']}}">
        <input type="number" name="skor[]" step="any" min="0" max="10">

    @endif

@endif