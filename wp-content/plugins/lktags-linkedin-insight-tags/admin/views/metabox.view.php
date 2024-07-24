<div class="misc-pub-section misc-pub-section-last"><span id="timestamp">

    <div class="lktags-field">
        
        <p><label><?php echo  esc_html__( 'Add Event-specific image pixel*', 'lktags-linkedin-insight-tags' ); ?></label></p>

        <div class="lktags-switch-radio">

            <input type="radio" id="lktags_event_btn1" name="lktags_event" value="lktags_event_yes" <?php if ( isset( $lktags_event ) ) echo 'checked="checked"'; ?> />
            <label for="lktags_event_btn1"><?php echo esc_html__( 'Yes', 'lktags-linkedin-insight-tags' ); ?></label>

            <input type="radio" id="lktags_event_btn2" name="lktags_event" value="lktags_event_no" <?php if ( empty( $lktags_event ) ) echo 'checked="checked"'; ?> />
            <label for="lktags_event_btn2"><?php echo esc_html__( 'No', 'lktags-linkedin-insight-tags' ); ?></label>

        </div>

        <textarea name="lktags_eventarea" rows="3" class="lktags-area" placeholder="<?php echo __('Enter event event code here'); ?>" id="lktags_eventarea"><?php if (!empty($lktags_eventarea)) { echo $lktags_eventarea; } ?></textarea>

    </div>

    <p style="margin-top: 25px;"><?php echo  esc_html__( 'Note: Make sure to choose Yes and then copy-paste code in textarea. If you plan to use a Linkedin Pixel event on this page, make sure to disable Linkedin insight tag feature on settings page.', 'lktags-linkedin-insight-tags' ); ?></p>
    <p><?php echo  esc_html__( '*Please read more details about Linkedin Event in FAQ', 'lktags-linkedin-insight-tags' ); ?></p>

</div>