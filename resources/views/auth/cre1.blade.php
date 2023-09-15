<html>
<head>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <script src="{{ asset('assets/js/canvas.js') }}"></script>
    {{-- <script src="canvas.js"></script> --}}
  {{-- <link href="main.css" rel="stylesheet"> --}}
  <link href="{{ asset('assets/css/main.css') }}" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" rel="stylesheet">
  <meta name="viewport" content="width=700">
    <link rel="icon" href="https://www.simbalian.org/wp-content/uploads/2021/04/cropped-favicon-32x32.png" sizes="32x32" />
<link rel="icon" href="https://www.simbalian.org/wp-content/uploads/2021/04/cropped-favicon-192x192.png" sizes="192x192" />
<link rel="apple-touch-icon" href="https://www.simbalian.org/wp-content/uploads/2021/04/cropped-favicon-180x180.png" />
<meta name="msapplication-TileImage" content="https://www.simbalian.org/wp-content/uploads/2021/04/cropped-favicon-270x270.png" />
<title>Simbalian Cycling Community &#8211; Happy &#8211; Healthy &#8211; Hungry &#8211; Hindustan</title>


</head>
<body>
  {{-- <button onclick="getCertificate()">Generate PDF</button> --}}
      <center>
        <div id="html-content-holder" style="background: url({{asset('assets/certi/certy.png')}}) no-repeat #fff; background-size:contain; width: 600px; height: 900px; margin:20px; padding:25px; position: relative;">
        {{-- <input type="text" value="" placeholder="Enter Your Name" class="youName"  >
        <div class="km"><input type="text" value="" placeholder="00" class="youPos"  > KM</div> --}}
        <span class="youName">{{ucfirst(isset($data['name'])?$data['name']:'')}} </span>          
        <div class="km"><span class="youPos"> ({{number_format($data['total']/1000,2)}} Kms)</span></div>  
        <div class="printcls" >
                
                <div class="avatar-wrapper">                    
                    <img class="profile-pic" src="{{asset('assets/certi/upload.png')}}" />
                    <div class="upload-button">                        
                    </div>
                    <input class="file-upload" type="file" accept="image/*"/>
                </div>
            </div>           
        </div>

     
        <input id="btn_convert" type="button" value="Create & Download" />        
        <!-- <a id="btn-Convert-Html2Image" href="#">Download</a> -->
        <br />
        {{-- <h3>Preview :</h3> --}}
        <div id="previewImg">
        </div>
 
    <script>
       document.getElementById("btn_convert").addEventListener("click", function() {
    html2canvas(document.getElementById("html-content-holder"),
      {
        allowTaint: true,
        useCORS: true
      }).then(function (canvas) {
        var anchorTag = document.createElement("a");
        document.body.appendChild(anchorTag);
        document.getElementById("previewImg").appendChild(canvas);
        anchorTag.download = "sacc2023";
        anchorTag.href = canvas.toDataURL();
        anchorTag.target = '_blank';
        anchorTag.click();
      });
  });


  $(document).ready(function() {
  
    var readURL = function(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('.profile-pic').attr('src', e.target.result);
            }
    
            reader.readAsDataURL(input.files[0]);
        }
    }
   
    $(".file-upload").on('change', function(){
        readURL(this);
    });
    
    $(".upload-button").on('click', function() {
       $(".file-upload").click();
    });
});
   </script>


</center>

</body>
</html>