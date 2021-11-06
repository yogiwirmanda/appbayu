@extends('master.main');
@section('content')
<script>
    $(document).ready(function(e){
        var xhr = new XMLHttpRequest();
        var params = 'apikey=28fd5a102cf00cacb299a66d1fe866b3&phone=081217018168&message=jancok kon we';
        xhr.open('POST', 'http://localhost:3000/api/sendMessage', true);

        //Send the proper header information along with the request
        xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

        xhr.onload = function() {//Call a function when the state changes.
            if(xhr.status == 200) {
                alert(this.responseText);
            }
        }
        xhr.send(params);
    });
</script>
@endsection