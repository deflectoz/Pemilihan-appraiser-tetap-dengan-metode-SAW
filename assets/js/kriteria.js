/**
 * Created by sankester on 13/05/2017.
 */


function edit_kriteria(id){

    $('#formKriteria')[0].reset();
    $('#errors').empty();
    $('#errors').removeClass("alert");

    $.ajax({
        url : base_url + "kriteria/" + "getById/" + id,
        type : "GET",
        dataType: "JSON",
        success : function(data){
            $('[name="kdKriteria"]').val(data.kdKriteria);
            $('[name="kriteria"]').val(data.kriteria);

            if(data.sifat == 'B'){
                $('#benefit').prop('checked', true);
            }else{
                $('#cost').prop('checked', true);
            }

            $('[name="bobot"]').val(data.bobot);

            $('#form_kriteria').modal('show');
            $('.modal-title').text('Update Kriteria');

        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error adding / update data');
        }
    });
}

function save_kriteria() {
    var url;
    url =  base_url + "kriteria/"+ "updateKriteria";

    $('#errors').empty();
    // ajax adding data to database
    $.ajax({
        url : url,
        type: "POST",
        data: $('#formKriteria').serialize(),
        dataType: "JSON",
        success: function(data)
        {
            //if success close modal and reload ajax table
            if(data.valid == false){
                for (i in data) {
                    $('#errors').addClass("alert alert-danger alert-dismissable");
                    if(i !='valid'){
                        $('.alert').prepend("<p>"+data[i]+"</p>");
                    }
                }
            } else {
                $('#modal_form').modal('hide');
                location.reload();// for reload a page
            }
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error adding / update data');

        }
    });
}

function edit_item_kriteria(id){
    $('.modal-item-kriteria').css('width', '50%');
    $('.modal-item-kriteria').css('margin', '100px auto 100px auto');

    $('#formItemKriteria')[0].reset();
    $('#errors').empty();
    $('#errors').removeClass("alert");

    //edit ini, backup sudah di notepad
    $.ajax({
        url : base_url + "kriteria/" + "getSubById/" + id,
        type : "GET",
        dataType: "JSON",
        success : function(data){
            $('.list_item_modal').empty();
            $('[name="kdKriteria"]').val(data.kode);

            for(var i=0; i < data['param'].length; i++){
                //console.log(data['param'][i].subKriteria);
                count = i + 1;
                $('.list_item_modal').append('<div class="form-group><label class="control-label col-sm-12">Data Kriteria '+count+'</label>');
                $('.list_item_modal').append('<div class="input-group mb-3"><input name="subKriteria_'+count+'" placeholder="Item Kriteria '+count+'" value="'+data['param'][i].subKriteria+'" type="text" class="form-control" placeholder="a" aria-label="a" aria-describedby="basic-addon2"><div class="input-group-append"><span class="input-group-text" id="basic-addon2">Value : '+data['param'][i].value+'</span><input name="kdSubKriteria_'+count+'" type="hidden" value="'+data['param'][i].kdSubKriteria+'"></div></div></div>');
                
                // $('.list_item_modal').append('<div class="col-sm-12"><input name="subKriteria_'+count+'" placeholder="Item Kriteria '+count+'" class="form-control" type="text" value="'+data['param'][i].subKriteria+'"><input name="kdSubKriteria_'+count+'" type="hidden" value="'+data['param'][i].kdSubKriteria+'"></div>');
                // $('.list_item_modal').append('<div class="col-sm-12"><label class="control-label col-md-4">Value</label><div class="col-md-6"><input name="value_'+count+'" placeholder="" class="form-control" type="text" value="'+data['param'][i].value+'" readonly></div></div>');
            }

            $('#form_item_kriteria').modal('show');
            $('.modal-title').text('Update Item Kriteria');

        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error adding / update data');
        }
    });
}

$("#form_item_kriteria").on("hidden.bs.modal", function () {
    $('#formItemKriteria')[0].reset();
});

function save_item_kriteria() {
    var url;
    url =  base_url + "kriteria/"+ "updateSubKriteria";

    $('#errors').empty();

     //ajax adding data to database
    $.ajax({
        url : url,
        type: "POST",
        data: $('#formItemKriteria').serialize(),
        dataType: "JSON",
        success: function(data)
        {
            //if success close modal and reload ajax table
            if(data.valid == false){
                for (i in data) {
                    $('#errors').addClass("alert alert-danger alert-dismissable");
                    if(i !='valid'){
                        $('.alert').prepend("<p>"+data[i]+"</p>");
                    }
                }
            } else {
                $('#modal_form').modal('hide');
                location.reload();// for reload a page
            }
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error adding / update data');
        }
    });
}

function hapus_kriteria(id){
        $.ajax({
            url :  base_url + "kriteria/" + "delete/"+id,
            type : "POST",
            dataType : "JSON",
            success : function(data){
                location.reload();
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error adding / update data');
            }
        });
}

function lihat_kriteria(id){
    $('.view-detail-kriteria').css('width', '50%');
    $('.view-detail-kriteria').css('margin', '100px auto 100px auto');

    $('#viewKodeKriteria').text("");
    $('#viewKriteria').text("");
    $('#viewSifat').text("");
    $('#viewBobot').text("");

    for(var i=1; i<=5; i++){
        var itemkriteria = 'viewItemKriteria' + i;
        var valueKriteria = 'viewValue' + i;

        $("#" + itemkriteria ).text("");
        $("#" + valueKriteria ).text("");
    }

    $.ajax({
        url: base_url + "kriteria/" + "detail/"+id,
        type : "POST",
        dataType : "JSON",
        success:  function(data){
            $('#viewKodeKriteria').val(data.kriteria.kdKriteria);
            $('#viewKriteria').val(data.kriteria.kriteria);
            $('#viewSifat').val(data.kriteria.sifat);
            $('#viewBobot').val(data.kriteria.bobot);
            //console.log(data.subkriteria);
            var countObj = Object.keys(data.subkriteria).length
            $('.item-krit').empty();
            for(var item in data.subkriteria){
                var index = parseInt(item) + 1;
                var itemkriteria = 'viewItemKriteria' + index;
                var valueKriteria = 'viewValue' + index;
                var newHtml = ('<label for="">Nama Sub Kriteria</label><div class="input-group mb-3"><input placeholder="Item Kriteria" value="'+data.subkriteria[item].subKriteria+'" type="text" class="form-control" placeholder="a"aria-label="a" aria-describedby="basic-addon2" readonly><div class="input-group-append"><span readonly class="input-group-text" id="basic-addon2">Value : '+data.subkriteria[item].value+'</span></div></div>');
                var newHTML = ('<div class="col-md-4"><b>Nama Sub Kriteria :</b></div><div class="col-md-3"><div class="left"></div></div><div class="col-sm-5"><div class="col-md-7"><b>Value :</b></div><div class="col-md-3"><div class="left"></div></div></div>');
                $(".item-krit").append( newHtml );
            }
            for(var c=1; c<=countObj; c++){
                console.log('Angka '+c+'')
            }
            $('#view_kriteria').modal('show');
            $('#view_kriteria .modal-title').text('Detail Kriteria');
        }
    });
}


    $(document).ready(function(){   
        var maxRow = 4;
        var i = 1;  
   
      $('#add').click(function(){  
          if(i <= maxRow){   
            i++; 
            $('#dynamic_field').append('<div class="row" id="row'+i+'"><div class="col-md-11 pr-1"><div class="form-group"><label class="control-label" for="">Komponen Kriteria: '+i+' Dengan Value: '+i+'</label><input type="text" class="form-control" id="itemKriteria" placeholder="Inputkan Kriteria"name="itemKriteria[]" autocomplete="off"><input type="hidden" name="value[]" value="'+i+'"></div></div><div class="col-md-1 pl-1"><button type="button" name="remove" id="'+i+'" class="btn btn-danger btn_remove">X</button></div></div>');     
            // $('#dynamic_field').append('<div id="row'+i+'"><div class="form-group"><label class="control-label col-sm-2" for="name">Komponen Kriteria: '+i+'</label><div class="col-sm-8"><input type="text" class="form-control"placeholder="Inputkan Kriteria" name="itemKriteria[]" autocomplete="off"><input type="hidden" name="value[]" value="'+i+'"></div><div class="col-sm-1"><small>Bobot = '+i+'</small></div><div class="col-sm-1"></div></div></div>'); 
        }
         });
     
     $(document).on('click', '.btn_remove', function(){  
           var button_id = $(this).attr("id"); 
           var res = confirm('Are You Sure You Want To Delete This?');
           if(res==true){
           $('#row'+button_id+'').remove();  
           $('#'+button_id+'').remove();  
           i--;
           }
      });  
  
    });  

