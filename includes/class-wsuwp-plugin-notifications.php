<?php

class WSUWP_Plugin_Notifications {
	/**
	 * @var WSUWP_Plugin_Notifications
	 */
	private static $instance;

	/**
	 * Maintain and return the one instance. Initiate hooks when
	 * called the first time.
	 *
	 * @since 0.0.1
	 *
	 * @return \WSUWP_Plugin_Notifications
	 */
	public static function get_instance() {
		if ( ! isset( self::$instance ) ) {
			self::$instance = new WSUWP_Plugin_Notifications();
			self::$instance->setup_hooks();
		}
		return self::$instance;
	}

	/**
	 * Setup hooks to include.
	 *
	 * @since 0.0.1
	 */
	public function setup_hooks() {}

	/**
	 * Sends a notification to a Slack Webhook.
	 *
	 * @since 0.0.1
	 *
	 * @param string $room    The name (without hashtag) of the room.
	 * @param string $data    The text of the notification. In a future version, this will support an array.
	 * @param string $context The context of the notification.
	 *
	 * @return bool True if successful, False if not.
	 */
	public function send_slack_notification( $room, $data, $context = 'default' ) {
		$message = array(
			'channel' => '#' . sanitize_key( $room ),
			'mrkdown' => true,
			'username' => 'wsuwp-notifications',
			'text' => $data,
			'icon_emoji' => ':saxophone:',
		);

		$payload = 'payload=' . wp_json_encode( $message );

		$url = apply_filters( 'wsuwp_slack_notification_url', '', $context, $room, $data );

		if ( empty( $url ) ) {
			return false;
		}

		$response = wp_remote_post( $url, $payload );

		if ( is_wp_error( $response ) ) {
			return false;
		}

		return true;
	}
}
