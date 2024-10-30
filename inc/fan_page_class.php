<?php
/**
 * @package Facebook Fan Page
 * @version 1.0
 * @ Fb Fan Page Class
 */
class Fb_Fan_Page extends WP_Widget {

    /**
     * Sets up the widgets name etc
     */
    public function __construct() {
        $widget_ops = array(
            'classname' => 'fb_fan_page',
            'description' => 'Facebook Fan Page',
        );
        parent::__construct( 'fb_fan_page', 'Modern fan page plugin', $widget_ops );
    }

    /**
     * Outputs the content of the widget
     *
     * @param array $args
     * @param array $instance
     */
    public function widget( $args, $instance ) {
        // outputs the content of the widget
       $fb_data = array();
        $title = $instance['title'] ? $instance['title'] : 'Title';
        $fb_data['page_url'] = $instance['page_url'] ? $instance['page_url'] : 'https://www.facebook.com/your_page_user_name/';
        $fb_data['tabs'] = $instance['tabs'] ? $instance['tabs'] : 'timeline';
        $fb_data['width'] = $instance['width'] ? $instance['width'] : 300;
        $fb_data['height'] = $instance['height'] ? $instance['height'] : 300;
        $fb_data['small_header'] = $instance['small_header'] ? $instance['small_header'] : 'yes';
        $fb_data['adapt_height_container'] = $instance['adapt_height_container'] ? $instance['adapt_height_container'] : 'no';
        $fb_data['hide_cover'] = $instance['hide_cover'] ? $instance['hide_cover'] : 'yes';
        $fb_data['show_firends'] = $instance['show_firends'] ? $instance['show_firends'] : 'yes';

      echo $args['before_widget'];
      echo $args['before_title'];
      echo $title;
      echo $args['after_title'];
        $this->fb_fan_page_frontend_content($instance);
      echo $args['after_widget'];

    }

    /**
     * Outputs the options form on admin
     *
     * @param array $instance The widget options
     */
    public function form( $instance ) {
        // outputs the options form on admin
        $this->fb_fan_page_form_backend($instance);
    }

    /**
     * Processing widget options on save
     *
     * @param $instance
     * @return void
     */
//    public function update( $new_instance, $old_instance ) {
//        // processes widget options to be saved
//    }

//Backend Form
    public function fb_fan_page_form_backend($instance){
        $title = $instance['title'] ? $instance['title'] : 'Title';
        $page_url = $instance['page_url'] ? $instance['page_url'] : 'https://www.facebook.com/your_page_user_name/';
        $tabs = $instance['tabs'] ? $instance['tabs'] : 'timeline';
        $width = $instance['width'] ? $instance['width'] : 300;
        $height = $instance['height'] ? $instance['height'] : 300;
        $small_header = $instance['small_header'] ? $instance['small_header'] : 'yes';
        $adapt_height_container = $instance['adapt_height_container'] ? $instance['adapt_height_container'] : 'no';
        $hide_cover = $instance['hide_cover'] ? $instance['hide_cover'] : 'yes';
        $show_firends = $instance['show_firends'] ? $instance['show_firends'] : 'yes';
        ?>
        <p>
            <label for="<?php echo $this->get_field_id('title')?>"><?php _e('Title','fbfp');?></label>
            <input class="widefat" type="text" name="<?php echo $this->get_field_name('title')?>" value="<?php echo esc_attr($title);?>" id="<?php echo $this->get_field_id('title')?>">
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('page_url')?>"><?php _e('Page URL','fbfp');?></label>
            <input class="widefat" type="text" name="<?php echo $this->get_field_name('page_url')?>" value="<?php echo esc_attr($page_url);?>" id="<?php echo $this->get_field_id('page_url')?>">
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('tabs')?>"><?php _e('Choose Tab Below','fbfp');?></label>
            <select name="<?php echo $this->get_field_name('tabs')?>" id="<?php echo $this->get_field_id('tabs')?>" class="widefat">
                <option <?php echo $tabs=='timeline' ? 'selected' : '';?> value="timeline"> <?php _e('Timeline','fbfp')?></option>
                <option <?php echo $tabs=='events' ? 'selected' : '';?> value="events"> <?php _e('Events','fbfp')?></option>
                <option <?php echo $tabs=='messages' ? 'selected' : '';?> value="messages"> <?php _e('Messages','fbfp')?></option>
                <option <?php echo $tabs=='shownotabs' ? 'selected' : '';?> value="shownotabs"> <?php _e('Show No Tabs','fbfp')?></option>
            </select>
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('adapt_height_container')?>"><?php _e('Adapt height container','fbfp');?></label>
            <select name="<?php echo $this->get_field_name('adapt_height_container')?>" id="<?php echo $this->get_field_id('adapt_height_container')?>" class="widefat">
                <option <?php echo $adapt_height_container=='yes' ? 'selected' : '';?> value="yes"> <?php _e('Yes','fbfp')?></option>
                <option <?php echo $adapt_height_container=='no' ? 'selected' : '';?> value="no"> <?php _e('No','fbfp')?></option>
            </select>
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('width')?>"><?php _e('Width','fbfp');?></label>
            <input class="widefat" type="text" name="<?php echo $this->get_field_name('width')?>" value="<?php echo esc_attr($width);?>" id="<?php echo $this->get_field_id('width')?>">
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('height')?>"><?php _e('Height','fbfp');?></label>
            <input class="widefat" type="text" name="<?php echo $this->get_field_name('height')?>" value="<?php echo esc_attr($height);?>" id="<?php echo $this->get_field_id('height')?>">
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('small_header')?>"><?php _e('Small Header','fbfp');?></label>
            <select name="<?php echo $this->get_field_name('small_header')?>" id="<?php echo $this->get_field_id('small_header')?>" class="widefat">
                <option <?php echo $small_header=='yes' ? 'selected' : '';?> value="yes"> <?php _e('Yes','fbfp')?></option>
                <option <?php echo $small_header=='no' ? 'selected' : '';?> value="no"> <?php _e('No','fbfp')?></option>
            </select>
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('show_firends')?>"><?php _e('Show firends Faces','fbfp');?></label>
            <select name="<?php echo $this->get_field_name('show_firends')?>" id="<?php echo $this->get_field_id('show_firends')?>" class="widefat">
                <option <?php echo $show_firends=='yes' ? 'selected' : '';?> value="yes"> <?php _e('Yes','fbfp')?></option>
                <option <?php echo $show_firends=='no' ? 'selected' : '';?> value="no"> <?php _e('No','fbfp')?></option>
            </select>
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('hide_cover')?>"><?php _e('Hide cover photo','fbfp');?></label>
            <select name="<?php echo $this->get_field_name('hide_cover')?>" id="<?php echo $this->get_field_id('hide_cover')?>" class="widefat">
                <option <?php echo $hide_cover=='yes' ? 'selected' : '';?> value="yes"> <?php _e('Yes','fbfp')?></option>
                <option <?php echo $hide_cover=='no' ? 'selected' : '';?> value="no"> <?php _e('No','fbfp')?></option>
            </select>
        </p>
<?php
    }
    public function fb_fan_page_frontend_content($fb_data){
//        $fb_data['page_url'] = $instance['page_url'] ? $instance['page_url'] : 'https://www.facebook.com/facebook/';
//        $fb_data['tabs'] = $instance['tabs'] ? $instance['tabs'] : 'timeline';
//        $fb_data['width'] = $instance['width'] ? $instance['width'] : 300;
//        $fb_data['height'] = $instance['height'] ? $instance['height'] : 300;
//        $fb_data['small_header'] = $instance['small_header'] ? $instance['small_header'] : 'yes';
//        $fb_data['adapt_height_container'] = $instance['adapt_height_container'] ? $instance['adapt_height_container'] : 'no';
//        $fb_data['hide_cover'] = $instance['hide_cover'] ? $instance['hide_cover'] : 'yes';
//        $fb_data['show_firends'] = $instance['show_firends'] ? $instance['show_firends'] : 'yes';
?>


        <div class="fb-page"
             data-href="<?php echo $fb_data['page_url']; ?>"
            <?php if($fb_data['tabs']!='shownotabs'):?>
             data-tabs="<?php if($fb_data['tabs']=='timeline'){
                 echo "timeline";
             }elseif ($fb_data['tabs']=='events'){
                 echo "events";
             }elseif ($fb_data['tabs']=='messages'){
                 echo "messages";
             }?>"
            <?php endif;?>
             data-width="<?php echo $fb_data['width'];?>"
             data-height="<?php echo $fb_data['height'];?>"

             data-small-header="<?php if($fb_data['small_header']=='yes'){
                echo "yes";
             }else{
                 echo "no";
             }?>"

             data-adapt-container-width="<?php if($fb_data['adapt_height_container']=='yes'){
                 echo "yes";
             }else{
                 echo "no";
             }?>"
             data-hide-cover="<?php if($fb_data['hide_cover']=='yes'){
                 echo "yes";
             }else{
                 echo "no";
             }?>"
             data-show-facepile="<?php if($fb_data['show_firends']=='yes'){
                 echo "yes";
             }else{
                 echo "no";
             }?>">
            <blockquote cite="<?php echo $fb_data['page_url'];?>"
                        class="fb-xfbml-parse-ignore">
                <a href="<?php echo $fb_data['page_url'];?>"><!--Sumon Sarker--></a>
            </blockquote>
        </div>
    <?php
    }
}



