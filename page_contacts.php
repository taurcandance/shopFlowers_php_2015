<?php
require_once 'user_initial.php';
require_once 'content_head_and_scripts.php';
require_once 'content_logo.php';
require_once 'content_headerMenu.php';
require_once 'content_contacts.php';
require_once 'content_footer.php';

init_user();
print_head_and_scripts();
print_logo();
print_header_menu();
print_contacts();
print_footer();