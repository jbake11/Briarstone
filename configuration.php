<?php
class JConfig {
<<<<<<< HEAD
=======
<<<<<<< HEAD
>>>>>>> f7a13747de162a3787cb8cf33bee7a57df7e3cc1
	public $offline = '0';
	public $offline_message = 'This site is down for maintenance.<br /> Please check back again soon.';
	public $display_offline_message = '1';
	public $offline_image = '';
<<<<<<< HEAD
	public $sitename = 'Briarstone Construction';
=======
	public $sitename = 'Briarstone Building, Inc.';
>>>>>>> f7a13747de162a3787cb8cf33bee7a57df7e3cc1
	public $editor = 'tinymce';
	public $captcha = '0';
	public $list_limit = '20';
	public $root_user = '42';
	public $access = '1';
	public $dbtype = 'mysql';
	public $host = 'localhost';
<<<<<<< HEAD
	public $user = 'briar3_briar3';
	public $password = 'V]e&#4A$L7nT';
	public $db = 'briar3_briar3';
=======
	public $user = 'root';
	public $password = 'jeXu!a#a';
	public $db = 'briarstone';
>>>>>>> f7a13747de162a3787cb8cf33bee7a57df7e3cc1
	public $dbprefix = 'netjv_';
	public $secret = 'FBVtggIk5lAzEU9H';
	public $gzip = '0';
	public $error_reporting = 'default';
	public $helpurl = 'http://help.joomla.org/proxy/index.php?option=com_help&keyref=Help{major}{minor}:{keyref}';
	public $ftp_host = '';
	public $ftp_port = '';
	public $ftp_user = '';
	public $ftp_pass = '';
	public $ftp_root = '';
	public $ftp_enable = '0';
<<<<<<< HEAD
	public $tmp_path = '/home/briar3/public_html/tmp';
	public $log_path = '/home/briar3/public_html/log';
=======
	public $tmp_path = '/tmp';
	public $log_path = '/var/log/briarstone';
>>>>>>> f7a13747de162a3787cb8cf33bee7a57df7e3cc1
	public $live_site = '';
	public $force_ssl = '0';
	public $offset = 'UTC';
	public $lifetime = '15';
	public $session_handler = 'database';
	public $mailer = 'mail';
	public $mailfrom = '';
	public $fromname = '';
	public $sendmail = '/usr/sbin/sendmail';
	public $smtpauth = '0';
	public $smtpuser = '';
	public $smtppass = '';
	public $smtphost = 'localhost';
<<<<<<< HEAD
	public $caching = '2';
=======
	public $caching = '0';
>>>>>>> f7a13747de162a3787cb8cf33bee7a57df7e3cc1
	public $cachetime = '15';
	public $cache_handler = 'file';
	public $debug = '0';
	public $debug_lang = '0';
<<<<<<< HEAD
	public $MetaDesc = 'Briarstone Construction';
	public $MetaKeys = 'Briarstone Construction';
=======
	public $MetaDesc = 'Welcome to Briarstone Building, Inc. We specialize in new residential construction and remodeling. Located in Northville, Michigan.';
	public $MetaKeys = 'briarstone, building, remodel, construction, contractor, additions, michigan, new, home, residential, builder, northville, floor plans, realty, realtor, kitchen, basement';
>>>>>>> f7a13747de162a3787cb8cf33bee7a57df7e3cc1
	public $MetaTitle = '1';
	public $MetaAuthor = '1';
	public $MetaVersion = '0';
	public $robots = '';
	public $sef = '1';
	public $sef_rewrite = '1';
	public $sef_suffix = '0';
	public $unicodeslugs = '0';
	public $feed_limit = '10';
	public $feed_email = 'author';
	public $memcache_persist = '1';
	public $memcache_compress = '0';
	public $memcache_server_host = 'localhost';
	public $memcache_server_port = '11211';
	public $memcached_persist = '1';
	public $memcached_compress = '0';
	public $memcached_server_host = 'localhost';
	public $memcached_server_port = '11211';
	public $proxy_enable = '0';
	public $proxy_host = '';
	public $proxy_port = '';
	public $proxy_user = '';
	public $proxy_pass = '';
	public $mailonline = '1';
	public $smtpsecure = 'none';
	public $smtpport = '25';
	public $MetaRights = '';
<<<<<<< HEAD
	public $sitename_pagetitles = '1';
=======
	public $sitename_pagetitles = '0';
>>>>>>> f7a13747de162a3787cb8cf33bee7a57df7e3cc1
	public $session_memcache_server_host = 'localhost';
	public $session_memcache_server_port = '11211';
	public $session_memcached_server_host = 'localhost';
	public $session_memcached_server_port = '11211';
	public $frontediting = '1';
	public $cookie_domain = '';
	public $cookie_path = '';
	public $asset_id = '1';
<<<<<<< HEAD
}
=======
=======

    public $offline = '0';
    public $offline_message = 'This site is down for maintenance.<br /> Please check back again soon.';
    public $display_offline_message = '1';
    public $offline_image = '';
    public $sitename = 'Briarstone Construction';
    public $editor = 'tinymce';
    public $captcha = '0';
    public $list_limit = '20';
    public $root_user = '42';
    public $access = '1';
    public $dbtype = 'mysql';
    public $host = 'localhost';
    public $user = 'briar3_briar3';
    public $password = 'V]e&#4A$L7nT';
    public $db = 'briar3_briar3';
    public $dbprefix = 'netjv_';
    public $secret = 'FBVtggIk5lAzEU9H';
    public $gzip = '0';
    public $error_reporting = 'default';
    public $helpurl = 'http://help.joomla.org/proxy/index.php?option=com_help&keyref=Help{major}{minor}:{keyref}';
    public $ftp_host = '';
    public $ftp_port = '';
    public $ftp_user = '';
    public $ftp_pass = '';
    public $ftp_root = '';
    public $ftp_enable = '0';
    public $tmp_path = '/tmp';
    public $log_path = '/var/log/briarstone';
    public $live_site = '';
    public $force_ssl = '0';
    public $offset = 'UTC';
    public $lifetime = '15';
    public $session_handler = 'database';
    public $mailer = 'mail';
    public $mailfrom = '';
    public $fromname = '';
    public $sendmail = '/usr/sbin/sendmail';
    public $smtpauth = '0';
    public $smtpuser = '';
    public $smtppass = '';
    public $smtphost = 'localhost';
    public $caching = '0';
    public $cachetime = '15';
    public $cache_handler = 'file';
    public $debug = '0';
    public $debug_lang = '0';
    public $MetaDesc = 'Briarstone Construction';
    public $MetaKeys = 'Briarstone Construction';
    public $MetaTitle = '1';
    public $MetaAuthor = '1';
    public $MetaVersion = '0';
    public $robots = '';
    public $sef = '1';
    public $sef_rewrite = '1';
    public $sef_suffix = '0';
    public $unicodeslugs = '0';
    public $feed_limit = '10';
    public $feed_email = 'author';
    public $memcache_persist = '1';
    public $memcache_compress = '0';
    public $memcache_server_host = 'localhost';
    public $memcache_server_port = '11211';
    public $memcached_persist = '1';
    public $memcached_compress = '0';
    public $memcached_server_host = 'localhost';
    public $memcached_server_port = '11211';
    public $proxy_enable = '0';
    public $proxy_host = '';
    public $proxy_port = '';
    public $proxy_user = '';
    public $proxy_pass = '';
    public $mailonline = '1';
    public $smtpsecure = 'none';
    public $smtpport = '25';
    public $MetaRights = '';
    public $sitename_pagetitles = '0';
    public $session_memcache_server_host = 'localhost';
    public $session_memcache_server_port = '11211';
    public $session_memcached_server_host = 'localhost';
    public $session_memcached_server_port = '11211';
    public $frontediting = '1';
    public $cookie_domain = '';
    public $cookie_path = '';
    public $asset_id = '1';

>>>>>>> 86f613cadc3cf496fc2e7da6f20540f81f12113d
}
>>>>>>> f7a13747de162a3787cb8cf33bee7a57df7e3cc1
