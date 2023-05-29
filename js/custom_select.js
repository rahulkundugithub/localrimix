$(document).ready(function(){
    $('#parentcategory').change(function(){
            alert('hi');
        var parentid=$(this).val();
        alert(parentid);
        if(parentid>0)
        {
            $.ajax({//is being used to send data to load_subcategory page and to fetch result from that page
                    type:'POST',
                    url:'./load_subcategory.php',
                    data:{'parent_id':parentid},
                    success:function(result){
                        //alert(result);
                        $('#subcategory').html(result);
                        // if (result == 'success') {
                        //     alert('Successfully!');
                        // } else {
                        //     alert(response);
                        // }
                    }
                    
                });
        }
    });
});