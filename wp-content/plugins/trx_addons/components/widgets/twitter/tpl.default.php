<?php
/**
 * The style "default" of the Twitter
 *
 * @package WordPress
 * @subpackage ThemeREX Addons
 * @since v1.4.3
 */

$widget_args = get_query_var('trx_addons_args_widget_twitter');
$twitter_username = isset($widget_args['twitter_username']) ? $widget_args['twitter_username'] : '';	
$twitter_count = isset($widget_args['twitter_count']) ? $widget_args['twitter_count'] : '';	
$follow = isset($widget_args['follow']) ? (int) $widget_args['follow'] : 0;
$widget_args['columns'] = (int)$widget_args['columns'] < 1 ? $twitter_count : min($widget_args['columns'], $twitter_count);
$widget_args['columns'] = max(1, min(12, (int) $widget_args['columns']));
$widget_args['slider'] = $widget_args['slider'] > 0 && $twitter_count > $widget_args['columns'];
$widget_args['slides_space'] = max(0, (int) $widget_args['slides_space']);

?><div class="widget_content">
	<div class="sc_twitter sc_twitter_<?php
				echo esc_attr($widget_args['type']);
				?>"><?php

		if ($widget_args['slider']) {
			trx_addons_sc_show_slider_wrap_start('sc_twitter', $widget_args);
		} else if ((int)$widget_args['columns'] > 1) {
			?><div class="sc_twitter_columns sc_item_columns <?php echo esc_attr(trx_addons_get_columns_wrap_class()); ?> columns_padding_bottom"><?php
		} else {
			?><div class="sc_twitter_content sc_item_content"><?php
		}	

		$cnt = 0;
		if (is_array($widget_args['data']) && count($widget_args['data']) > 0) {
			foreach ($widget_args['data'] as $tweet) {
				if (substr($tweet['text'], 0, 1)=='@') continue;

				if ($widget_args['slider']) {
					?><div class="slider-slide swiper-slide"><?php
				} else if ((int)$widget_args['columns'] > 1) {
					?><div class="<?php echo esc_attr(trx_addons_get_column_class(1, $widget_args['columns'])); ?>"><?php
				}
				?>
				<div class="sc_twitter_item<?php if ($cnt==$twitter_count-1) echo ' last'; ?>">
					<div class="sc_twitter_item_icon icon-twitter"></div>
					<div class="sc_twitter_item_content"><a href="<?php echo esc_url('https://twitter.com/'.trim($twitter_username)); ?>" class="username" target="_blank">@<?php echo esc_html($tweet['user']['screen_name']); ?></a> <?php
						echo force_balance_tags(trx_addons_prepare_twitter_text($tweet));
					?></div>
				</div>
				<?php
				if ($widget_args['slider'] || (int)$widget_args['columns'] > 1) {
					?></div><?php
				}
				if (++$cnt >= $twitter_count) break;
			}
		}

		?></div><?php

		if ($widget_args['slider']) {
			trx_addons_sc_show_slider_wrap_end('sc_twitter', $widget_args);
		}

	?></div><!-- /.sc_twitter --><?php

    if ($follow) {
        ?><a href="<?php echo esc_url('http://twitter.com/'.trim($twitter_username)); ?>" class="widget_twitter_follow"><?php esc_html_e('Follow us', 'trx_addons'); ?></a><?php
    }

?></div><!-- /.widget_content -->