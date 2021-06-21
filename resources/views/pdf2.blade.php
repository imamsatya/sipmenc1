<!DOCTYPE html>
<html>
<head>
    <title>Hi</title>
    <script src="https://cdn.jsdelivr.net/npm/vue@2"></script>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
</head>
<body>
    {{-- <h1>{{ $title }}</h1>
    <p>{{ $date }}</p> --}}
    {{-- {{json_encode($data, TRUE)}} --}}
        {{-- {{$data['data'][0]['id']}} --}}
       
    
         {{-- {{ json_encode($data2[0])}} --}}
         {{-- {{ $data2 }} --}}
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
          {{-- <form action="{{route('downloadpdf', [$data2])}}" method="post">
              @csrf
          <button type="submit">download</button>
        </form> --}}
</body>
</html>