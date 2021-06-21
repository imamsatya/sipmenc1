<!DOCTYPE html>
<html>
<head>
    <title>Hi</title>
    <script src="https://cdn.jsdelivr.net/npm/vue@2"></script>
</head>
<body>
        {{-- {{$data2}} --}}
       <p>Yth. Penanggung Jawab Pengolahan BPS Provinsi Sulawesi Tengah <br>
        Di – <br>
        Tempat</p>
        
        <p> &nbsp;&nbsp; Berikut kami kirimkan daftar dokumen c1 yang telah di guillotine</p> <br>
        <table style="width:100%">
            <tr>
              <th>Kode Administrasi</th>
              <th>Jumlah Set Hitung</th>
              <th>Petugas</th>
              <th> Tanggal </th>
            </tr>
            @foreach ($data2 as $item)
            
            <tr>
                <td>{{ $item['kodeAdmin'] }}</td>
                <td>{{ $item['jumlahSetHitung'] }}</td>
                <td>{{ $item['petugas'] }}</td>
                <td>{{ $item['updated_at_custom'] }}</td>

              </tr>
            @endforeach
            
           
          </table>
          {{-- {{gettype($data2)}} --}}
          {{-- @php
           $a = json_encode($data2); 
          print_r( gettype($a));
          print_r($a);
          print($a[0])
          @endphp
          <form action="{{route('downloadpdf', $a)}}" method="get">
              @csrf
              <button type="submit">download</button>
        </form> --}}
</body>
</html>