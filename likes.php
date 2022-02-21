<?php

/**
 * Plugin Name: Likes Plugin
 * Description: This is version 0.1 for in test
 */

 

function  like_button()
{
   /*
    if(false === ($likes1 = get_transient('likes_value'))){
     $value = 0;
     set_transient('likes_value',$value, 12*60);
    }
    $value = get_transient('likes_value');
    */
    /*global $wp_query;
    $post_id = $wp_query->post->ID;  
    echo $post_id; 

    if( metadata_exists('post',$post_id , 'Likes_Btn') == 1){
        $metavalue= get_post_meta($post_id, 'Likes_Btn',true);
    }else{
        $metavalue = 0;
        add_post_meta($post_id,'Likes_Btn', $metavalue);     
    } 
        */
        if(false === ($likes1 = get_option('likes_value')))
        {
            $likes1 = 0;
            add_option('likes_value', $likes1);
        }else{
            $likes1 = get_option('Likes_value');
        }


    ?>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">  

    <button style="font-size: 24px" id ="likes_btn"> <em class="fa fa-thumbs-up"> </em><?php echo $likes1 ?> </button>  
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous">
        </script>
    
    <script>
    

    $("#likes_btn").click(function(){
            event.preventDefault();
            var link= "<?php echo admin_url('admin-ajax.php') ?>";
            var buttonText = $("#likes_btn").text();
            //alert(buttonText);
            jQuery.ajax({                    
                    url: link,
                    data:{
                        action:'btnlikes',
                        'btn_text':buttonText
                    },
                    type:'post',                    
                    success: function(result){
                        jQuery("#likes_btn").html( '<em class="fa fa-thumbs-up"> </em>'+result.data );

                        }
                                  
                });
            });
    
    </script>

<?php

}
add_shortcode('like_btn','like_button');

add_action('wp_ajax_btnlikes', 'ajax_btn_likes');
function ajax_btn_likes()
{
	$btn_value = trim($_POST['btn_text']);
	$btn_result = $btn_value + 1;
    update_option('likes_value',$btn_result);

  /*
    global $wp_query;
    $post_id = $wp_query->post->ID;  
    echo $post_id; 
    
    */
    //set_transient('likes_value',$btn_result,12*60);
            
    

    

	wp_send_json_success($btn_result);
}

function likes() {
    

    $metavalue1= get_option('likes_value');
    
    
  //  echo "this is Learn more button count " .$metavalue1;
  // echo " this is go to deal button count". $metavalue2;
   
   ?> 
   <table>
       <tr>
           <td>Likes Count</td>        
       </tr>
       <tr>
           <td> <?php echo($metavalue1) ?></td>
       </tr>
   </table> 
   <button id = "reset">reset</button>
   <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous">
        </script>
        <script>
  
   $("#reset").click(function (){
    <?php delete_post_meta(35,'new1');

   });
<?php
    /*
    // print_r($metavalue1);

*/
   
   
  }
  function likes_admin_menu() {
    add_menu_page(
          'Likes Api',// page title
          'Likes Api',// menu title
          'manage_options',// capability
          'likes-api',// menu slug
          'likes' // callback function
      );
  }
  add_action('admin_menu', 'likes_admin_menu');

?>
























































