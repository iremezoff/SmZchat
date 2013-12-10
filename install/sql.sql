DROP TABLE IF EXISTS `chat_banlist`;
CREATE TABLE `chat_banlist` (
  `id` int(11) NOT NULL auto_increment,
  `user` varchar(50) NOT NULL default '',
  `ip` varchar(15) NOT NULL default '',
  `ban` varchar(50) NOT NULL default '',
  `type` int(1) NOT NULL default '1',
  `reson` int(11) NOT NULL default '0',
  `mute_time` int(10) NOT NULL default '0',
  `mute_settime` int(30) NOT NULL default '0',
  PRIMARY KEY  (`id`)
);

DROP TABLE IF EXISTS `chat_compl`;
CREATE TABLE `chat_compl` (
  `id` int(11) NOT NULL auto_increment,
  `user` varchar(50) NOT NULL default '',
  `moder` varchar(50) NOT NULL default '',
  `time` int(30) NOT NULL default '0',
  `text` text NOT NULL,
  PRIMARY KEY  (`id`)
);

DROP TABLE IF EXISTS `chat_config`;
CREATE TABLE `chat_config` (
  `id` int(10) NOT NULL auto_increment,
  `name` varchar(25) default NULL,
  `value` text NOT NULL,
  `other` text NOT NULL,
  PRIMARY KEY  (`id`)
);

INSERT INTO `chat_config` VALUES (11, 'max_msgs', '1000', '11|||1|||������������ ���-�� �������� ��������� � �����||||||');
INSERT INTO `chat_config` VALUES (10, 'clear_compl', '10', '10|||1|||���-�� ����, �� ������� �������� ������ �� �������||||||');
INSERT INTO `chat_config` VALUES (8, 'max_sm', '8', '08|||1|||���-�� ����������� ���������� ������� � ���������||||||');
INSERT INTO `chat_config` VALUES (9, 'clear_logs', '1', '09|||1|||���-�� ����, �� ������� �������� ���� ����� ||||||');
INSERT INTO `chat_config` VALUES (7, 'savemsgcount', '55', '07|||1|||���-�� �������� � �� ��������� (��� ������ �������)||||||');
INSERT INTO `chat_config` VALUES (6, 'user_prunetime', '200', '06|||1|||���-�� ������, ����� ������� ���� ��������. ��� ������� "����������" � 10 ��� ������, ��� ������� "������" - � 4 ����||||||');
INSERT INTO `chat_config` VALUES (5, 'chat_refreshtime', '3', '05|||1|||������� ���������� ������ ����<br><small><b>����� 3 ������ ������ ������ �� �������������</b></small>||||||');
INSERT INTO `chat_config` VALUES (4, 'coding_site', '1', '04|||4|||��������� ������������ �����|||1|2|||windows-1251|koi8-u ');
INSERT INTO `chat_config` VALUES (3, 'admin_mail', 'remezov2004@mail.ru', '03|||1|||E-mail ��������������||||||');
INSERT INTO `chat_config` VALUES (2, 'chat_url', 'http://smzchat.kn', '02|||1|||����� URL �����||||||');
INSERT INTO `chat_config` VALUES (1, 'chat_title', 'SmZchat vioo3', '01|||1|||��������� ����||||||');
INSERT INTO `chat_config` VALUES (15, 'last', '1183405479', '');
INSERT INTO `chat_config` VALUES (16, 'type_str', '2', '');
INSERT INTO `chat_config` VALUES (17, 'font', '', '');
INSERT INTO `chat_config` VALUES (12, 'widthmax', '1024', '12|||1|||������������ ������ ����������� ���������������� ����������||||||');
INSERT INTO `chat_config` VALUES (13, 'heightmax', '768', '13|||1|||������������ ������ ����������� ���������������� ����������||||||');
INSERT INTO `chat_config` VALUES (14, 'sizemax', '100', '14|||1|||������������ ������ ����������� ���������������� ����������||||||');
INSERT INTO `chat_config` VALUES (18, 'noise', '1000', '');

DROP TABLE IF EXISTS `chat_ignore`;
CREATE TABLE `chat_ignore` (
  `id` int(11) NOT NULL auto_increment,
  `user` varchar(50) NOT NULL default '',
  `ignores` varchar(50) NOT NULL default '',
  PRIMARY KEY  (`id`)
);

DROP TABLE IF EXISTS `chat_language`;
CREATE TABLE `chat_language` (
  `id` int(11) NOT NULL auto_increment,
  `descr` varchar(50) NOT NULL default '',
  `value` text NOT NULL,
  `lang` varchar(50) NOT NULL default '',
  PRIMARY KEY  (`id`)
);

INSERT INTO `chat_language` VALUES (1, 'now', '������ � ����', 'russian');
INSERT INTO `chat_language` VALUES (2, 'status', '������', 'russian');
INSERT INTO `chat_language` VALUES (3, 'rooms', '�������', 'russian');
INSERT INTO `chat_language` VALUES (4, 'moder', '�������������', 'russian');
INSERT INTO `chat_language` VALUES (5, 'addition', '�������������', 'russian');
INSERT INTO `chat_language` VALUES (6, 'goto', '�������', 'russian');
INSERT INTO `chat_language` VALUES (7, 'smiles', '������', 'russian');
INSERT INTO `chat_language` VALUES (8, 'option', '���������', 'russian');
INSERT INTO `chat_language` VALUES (9, 'mail', '�����', 'russian');
INSERT INTO `chat_language` VALUES (10, 'send', '�������', 'russian');
INSERT INTO `chat_language` VALUES (11, 'private', '��������', 'russian');
INSERT INTO `chat_language` VALUES (12, 'exit', '�����', 'russian');
INSERT INTO `chat_language` VALUES (13, 'info', '����', 'russian');
INSERT INTO `chat_language` VALUES (14, 'ignore', '������������', 'russian');
INSERT INTO `chat_language` VALUES (15, 'unignore', '����� �����', 'russian');
INSERT INTO `chat_language` VALUES (16, 'addwarn', '������������', 'russian');
INSERT INTO `chat_language` VALUES (17, 'addcompl', '������������', 'russian');
INSERT INTO `chat_language` VALUES (18, 'addban', '��������', 'russian');
INSERT INTO `chat_language` VALUES (19, 'delban', '���������', 'russian');
INSERT INTO `chat_language` VALUES (20, 'addban2', '�������� ���', 'russian');
INSERT INTO `chat_language` VALUES (21, 'banlist', '������ �����', 'russian');
INSERT INTO `chat_language` VALUES (22, 'banlogs', '���� �����', 'russian');
INSERT INTO `chat_language` VALUES (23, 'rules', '�������', 'russian');
INSERT INTO `chat_language` VALUES (24, 'clearmess', '�������� ���������', 'russian');
INSERT INTO `chat_language` VALUES (25, 'refmess', '�������� ���������', 'russian');
INSERT INTO `chat_language` VALUES (26, 'myinfo', '��� ����������', 'russian');
INSERT INTO `chat_language` VALUES (27, 'conpanel', '������ ����������', 'russian');
INSERT INTO `chat_language` VALUES (28, 'newmess', '����� ���������', 'russian');
INSERT INTO `chat_language` VALUES (29, 'sendform', '����� ��������', 'russian');
INSERT INTO `chat_language` VALUES (30, 'autofocus', '��������� ������ �����', 'russian');
INSERT INTO `chat_language` VALUES (31, 'theme', '����', 'russian');
INSERT INTO `chat_language` VALUES (32, 'time', '�����', 'russian');
INSERT INTO `chat_language` VALUES (33, 'language', '����', 'russian');
INSERT INTO `chat_language` VALUES (34, 'apply', '���������', 'russian');
INSERT INTO `chat_language` VALUES (35, 'inbox', '��������', 'russian');
INSERT INTO `chat_language` VALUES (36, 'outbox', '���������', 'russian');
INSERT INTO `chat_language` VALUES (37, 'usemail', '������������', 'russian');
INSERT INTO `chat_language` VALUES (38, 'newletter', '��������', 'russian');
INSERT INTO `chat_language` VALUES (39, 'ups', '������', 'russian');
INSERT INTO `chat_language` VALUES (40, 'downs', '�����', 'russian');
INSERT INTO `chat_language` VALUES (41, 'on', '���', 'russian');
INSERT INTO `chat_language` VALUES (42, 'off', '����', 'russian');
INSERT INTO `chat_language` VALUES (43, 'back', '�����', 'russian');
INSERT INTO `chat_language` VALUES (44, 'myignlist', '������������', 'russian');
INSERT INTO `chat_language` VALUES (45, 'meignlist', '������������', 'russian');
INSERT INTO `chat_language` VALUES (46, 'ttime|hms', '�:�:�', 'russian');
INSERT INTO `chat_language` VALUES (47, 'ttime|hm', '�:�', 'russian');
INSERT INTO `chat_language` VALUES (48, 'ttime|ms', '�:�', 'russian');
INSERT INTO `chat_language` VALUES (49, 'tstatus|free', '�������� ��� ����', 'russian');
INSERT INTO `chat_language` VALUES (50, 'tstatus|away', '�������� ������', 'russian');
INSERT INTO `chat_language` VALUES (51, 'tstatus|na', '�������� ����������', 'russian');
INSERT INTO `chat_language` VALUES (52, 'tstatus|dnd', '�� ����������', 'russian');
INSERT INTO `chat_language` VALUES (53, 'notmess', '�� �� ����� ����� ���������', 'russian');
INSERT INTO `chat_language` VALUES (54, 'double', '�� ������������...', 'russian');
INSERT INTO `chat_language` VALUES (55, 'notnick', '�� ������ �������� ������ ����?!', 'russian');
INSERT INTO `chat_language` VALUES (56, 'administrator', '�������������', 'russian');
INSERT INTO `chat_language` VALUES (57, 'moderator1', '������� ���������', 'russian');
INSERT INTO `chat_language` VALUES (58, 'moderator2', '������� ���������', 'russian');
INSERT INTO `chat_language` VALUES (59, 'user', '������������', 'russian');
INSERT INTO `chat_language` VALUES (60, 'clear', '��������', 'russian');
INSERT INTO `chat_language` VALUES (61, 'person', '������ ���������', 'russian');
INSERT INTO `chat_language` VALUES (62, 'touser', '����', 'russian');
INSERT INTO `chat_language` VALUES (63, 'fromuser', '�� ����', 'russian');
INSERT INTO `chat_language` VALUES (64, 'when', '�����', 'russian');
INSERT INTO `chat_language` VALUES (65, 'action', '��������', 'russian');
INSERT INTO `chat_language` VALUES (66, 'total', '�����', 'russian');
INSERT INTO `chat_language` VALUES (67, 'pages', '��������', 'russian');
INSERT INTO `chat_language` VALUES (68, 'confirm', '�� ������������� ������ ������� ��� ���������?', 'russian');
INSERT INTO `chat_language` VALUES (69, 'del', '�������', 'russian');
INSERT INTO `chat_language` VALUES (70, 'text', '����� ���������', 'russian');
INSERT INTO `chat_language` VALUES (71, 'onsmiles', '�������� ��������', 'russian');
INSERT INTO `chat_language` VALUES (72, 'sendletter', '���������', 'russian');
INSERT INTO `chat_language` VALUES (73, 'b', '�', 'russian');
INSERT INTO `chat_language` VALUES (74, 'i', '�', 'russian');
INSERT INTO `chat_language` VALUES (75, 'u', '�', 'russian');
INSERT INTO `chat_language` VALUES (76, 'sup', '���', 'russian');
INSERT INTO `chat_language` VALUES (77, 'sub', '���', 'russian');
INSERT INTO `chat_language` VALUES (78, 'error|nick', '�� �� ����� ��� ��������', 'russian');
INSERT INTO `chat_language` VALUES (79, 'error|self', '�� ����������� ��������� ����', 'russian');
INSERT INTO `chat_language` VALUES (80, 'error|theme', '�� �� ����� ���� ���������', 'russian');
INSERT INTO `chat_language` VALUES (81, 'error|text', '�� �� ����� ����� ���������', 'russian');
INSERT INTO `chat_language` VALUES (82, 'error|tox', '�������� �� ����������', 'russian');
INSERT INTO `chat_language` VALUES (83, 'error|yourlimit', '����� <b>�����</b> ������ ��������� ��������! ������� ������ ��������� � ��������� ��������', 'russian');
INSERT INTO `chat_language` VALUES (84, 'error|tolimit', '����� ������ ��������� <b>��������</b> ��������! ��������� �������� �����', 'russian');
INSERT INTO `chat_language` VALUES (85, 'error|oldpass', '�� ����� ������ ������', 'russian');
INSERT INTO `chat_language` VALUES (86, 'error|oldpass2', '������� ����� ������ ������', 'russian');
INSERT INTO `chat_language` VALUES (87, 'error|passes', '����� � ��������� ������ �� ���������', 'russian');
INSERT INTO `chat_language` VALUES (88, 'error|mail', '�� �� ����� e-mail', 'russian');
INSERT INTO `chat_language` VALUES (89, 'error|mail2', '�� ����� ������������ e-mail', 'russian');
INSERT INTO `chat_language` VALUES (90, 'error|mail3', '������������ � ����� e-mail ��� ���������������', 'russian');
INSERT INTO `chat_language` VALUES (91, 'error|about', '�� �� ����� ���������� � ����', 'russian');
INSERT INTO `chat_language` VALUES (92, 'error|path', '�� ������ ����', 'russian');
INSERT INTO `chat_language` VALUES (93, 'error|image', '�� ������� ��������', 'russian');
INSERT INTO `chat_language` VALUES (94, 'error|notfile', '���� ������', 'russian');
INSERT INTO `chat_language` VALUES (95, 'error|ext', '��� ����� ������ ���� <b>jpg</b>, <b>gif</b> ��� <b>png</b>', 'russian');
INSERT INTO `chat_language` VALUES (96, 'error|width', '������ �������� ������ ����������. ������������ ������ %s ��������', 'russian');
INSERT INTO `chat_language` VALUES (97, 'error|height', '������ �������� ������ ����������. ������������ ������ %s ��������', 'russian');
INSERT INTO `chat_language` VALUES (98, 'error|size', '����� �������� ������ �����������. ������������ ����� %s Kb', 'russian');
INSERT INTO `chat_language` VALUES (99, 'error|small', '������ ��� �������� ����������� ����� �����������', 'russian');
INSERT INTO `chat_language` VALUES (100, 'error|copy', '������ ��� �������� ����� �� ������', 'russian');
INSERT INTO `chat_language` VALUES (101, 'complete|send', '��������� ������� ����������!', 'russian');
INSERT INTO `chat_language` VALUES (102, 'complete|sendx', '��������� ������ ��� ����������� ���������!', 'russian');
INSERT INTO `chat_language` VALUES (103, 'complete|error', '��������� ������!', 'russian');
INSERT INTO `chat_language` VALUES (104, 'complete|copy', '���������� ���������', 'russian');
INSERT INTO `chat_language` VALUES (105, 'complete|del', '��������� ������� �������!', 'russian');
INSERT INTO `chat_language` VALUES (106, 'complete|delx', '��������� ������ ��� �������� ���������!', 'russian');
INSERT INTO `chat_language` VALUES (107, 'complete|load', '�������� ����� ������ �������', 'russian');
INSERT INTO `chat_language` VALUES (108, 'complete|errinfo', '��������� ������ ��� ��������� ����������', 'russian');
INSERT INTO `chat_language` VALUES (109, 'complete|edit', '���������� ������� ��������', 'russian');
INSERT INTO `chat_language` VALUES (110, 'complete|clearlogs', '���� ���� ������� �������!', 'russian');
INSERT INTO `chat_language` VALUES (111, 'complete|errlogs', '��������� ������ ��� �������� �����!', 'russian');
INSERT INTO `chat_language` VALUES (112, 'im', '�', 'russian');
INSERT INTO `chat_language` VALUES (113, 'aboutuser', '�� ���������', 'russian');
INSERT INTO `chat_language` VALUES (114, 'about', '� ����', 'russian');
INSERT INTO `chat_language` VALUES (115, 'email', 'E-mail', 'russian');
INSERT INTO `chat_language` VALUES (116, 'hidemail', '������ e-mail', 'russian');
INSERT INTO `chat_language` VALUES (117, 'yes', '��', 'russian');
INSERT INTO `chat_language` VALUES (118, 'no', '���', 'russian');
INSERT INTO `chat_language` VALUES (119, 'photo', '����', 'russian');
INSERT INTO `chat_language` VALUES (120, 'actphoto', '������� ����', 'russian');
INSERT INTO `chat_language` VALUES (121, 'edit', '��������������', 'russian');
INSERT INTO `chat_language` VALUES (122, 'edit2', '�������������', 'russian');
INSERT INTO `chat_language` VALUES (123, 'notfound', '�����������', 'russian');
INSERT INTO `chat_language` VALUES (124, 'oldpass', '������ ������', 'russian');
INSERT INTO `chat_language` VALUES (125, 'newpass', '����� ������', 'russian');
INSERT INTO `chat_language` VALUES (126, 'confpass', '����� � ��������� ������ �� ���������', 'russian');
INSERT INTO `chat_language` VALUES (127, 'cancel', '������', 'russian');
INSERT INTO `chat_language` VALUES (128, 'nick', '���', 'russian');
INSERT INTO `chat_language` VALUES (129, 'ip', 'IP', 'russian');
INSERT INTO `chat_language` VALUES (130, 'type', '���', 'russian');
INSERT INTO `chat_language` VALUES (131, 'tban|1', '�������� � ����', 'russian');
INSERT INTO `chat_language` VALUES (132, 'tban|2', '��������� ������', 'russian');
INSERT INTO `chat_language` VALUES (133, 'tban|3', '������ ������', 'russian');
INSERT INTO `chat_language` VALUES (134, 'reson', '�������', 'russian');
INSERT INTO `chat_language` VALUES (135, 'btime|300', '�������� �� 5 �����', 'russian');
INSERT INTO `chat_language` VALUES (136, 'btime|900', '�������� �� 15 �����', 'russian');
INSERT INTO `chat_language` VALUES (137, 'btime|1800', '�������� �� 30 �����', 'russian');
INSERT INTO `chat_language` VALUES (138, 'btime|3600', '�������� �� 1 ���', 'russian');
INSERT INTO `chat_language` VALUES (139, 'btime|5200', '�������� �� 2 ����', 'russian');
INSERT INTO `chat_language` VALUES (140, 'btime|18000', '�������� �� 6 �����', 'russian');
INSERT INTO `chat_language` VALUES (141, 'btime|43200', '�������� �� 12 �����', 'russian');
INSERT INTO `chat_language` VALUES (142, 'btime|86400', '�������� �� 1 ����', 'russian');
INSERT INTO `chat_language` VALUES (143, 'btime|172800', '�������� �� 2 ���', 'russian');
INSERT INTO `chat_language` VALUES (144, 'btime|999999999', '�������� �� ~ �����', 'russian');
INSERT INTO `chat_language` VALUES (145, 'id', 'id', 'russian');
INSERT INTO `chat_language` VALUES (146, 'moderator', '�����', 'russian');
INSERT INTO `chat_language` VALUES (147, 'to', '��', 'russian');
INSERT INTO `chat_language` VALUES (148, 'addwarn2', '�������� ��������������', 'russian');
INSERT INTO `chat_language` VALUES (149, 'addwarn3', '������� �������������� ���', 'russian');
INSERT INTO `chat_language` VALUES (150, 'text2', '�����<br><small>�� ����� 60 ��������</small>', 'russian');
INSERT INTO `chat_language` VALUES (151, 'clear2', '�������� ��', 'russian');
INSERT INTO `chat_language` VALUES (152, 'clear3', '�������� �� ���� ������', 'russian');
INSERT INTO `chat_language` VALUES (153, 'view', '��������', 'russian');
INSERT INTO `chat_language` VALUES (154, 'view2', '�������� ��', 'russian');
INSERT INTO `chat_language` VALUES (155, 'months|1', '������', 'russian');
INSERT INTO `chat_language` VALUES (156, 'months|2', '�������', 'russian');
INSERT INTO `chat_language` VALUES (157, 'months|3', '����', 'russian');
INSERT INTO `chat_language` VALUES (158, 'months|4', '������', 'russian');
INSERT INTO `chat_language` VALUES (159, 'months|5', '���', 'russian');
INSERT INTO `chat_language` VALUES (160, 'months|6', '����', 'russian');
INSERT INTO `chat_language` VALUES (161, 'months|7', '����', 'russian');
INSERT INTO `chat_language` VALUES (162, 'months|8', '������', 'russian');
INSERT INTO `chat_language` VALUES (163, 'months|9', '��������', 'russian');
INSERT INTO `chat_language` VALUES (164, 'months|10', '�������', 'russian');
INSERT INTO `chat_language` VALUES (165, 'months|11', '������', 'russian');
INSERT INTO `chat_language` VALUES (166, 'months|12', '�������', 'russian');
INSERT INTO `chat_language` VALUES (167, 'colors|1', '׸����', 'russian');
INSERT INTO `chat_language` VALUES (168, 'colors|2', '�����', 'russian');
INSERT INTO `chat_language` VALUES (169, 'colors|3', 'Ҹ���-���������', 'russian');
INSERT INTO `chat_language` VALUES (170, 'colors|4', 'Ҹ���-������', 'russian');
INSERT INTO `chat_language` VALUES (171, 'colors|5', '�������', 'russian');
INSERT INTO `chat_language` VALUES (172, 'colors|6', '������', 'russian');
INSERT INTO `chat_language` VALUES (173, 'colors|7', 'Ҹ���-�������', 'russian');
INSERT INTO `chat_language` VALUES (174, 'colors|8', 'Ҹ���-���������', 'russian');
INSERT INTO `chat_language` VALUES (175, 'colors|9', '���������', 'russian');
INSERT INTO `chat_language` VALUES (176, 'colors|10', '������', 'russian');
INSERT INTO `chat_language` VALUES (177, 'colors|11', '������� �����', 'russian');
INSERT INTO `chat_language` VALUES (178, 'colors|12', '�����', 'russian');
INSERT INTO `chat_language` VALUES (179, 'colors|13', '������-�����', 'russian');
INSERT INTO `chat_language` VALUES (180, 'colors|14', '�������', 'russian');
INSERT INTO `chat_language` VALUES (181, 'colors|15', '��������', 'russian');
INSERT INTO `chat_language` VALUES (182, 'colors|16', '���������', 'russian');
INSERT INTO `chat_language` VALUES (183, 'colors|17', '���������', 'russian');
INSERT INTO `chat_language` VALUES (184, 'colors|18', '���������', 'russian');
INSERT INTO `chat_language` VALUES (185, 'colors|19', '�����', 'russian');
INSERT INTO `chat_language` VALUES (186, 'colors|20', '���������', 'russian');
INSERT INTO `chat_language` VALUES (187, 'colors|21', '���������', 'russian');
INSERT INTO `chat_language` VALUES (188, 'colors|22', 'Ƹ����', 'russian');
INSERT INTO `chat_language` VALUES (189, 'colors|23', '����', 'russian');
INSERT INTO `chat_language` VALUES (190, 'colors|24', '�������', 'russian');
INSERT INTO `chat_language` VALUES (191, 'colors|25', '�������-�����', 'russian');
INSERT INTO `chat_language` VALUES (192, 'colors|26', '�����������', 'russian');
INSERT INTO `chat_language` VALUES (193, 'colors|27', '�������', 'russian');
INSERT INTO `chat_language` VALUES (194, 'colors|28', '������-������', 'russian');
INSERT INTO `chat_language` VALUES (195, 'colors|29', '�����', 'russian');
INSERT INTO `chat_language` VALUES (196, 'now', 'Now in chat', 'english');
INSERT INTO `chat_language` VALUES (197, 'status', 'Status', 'english');
INSERT INTO `chat_language` VALUES (198, 'rooms', 'Rooms', 'english');
INSERT INTO `chat_language` VALUES (199, 'moder', 'Moder', 'english');
INSERT INTO `chat_language` VALUES (200, 'addition', 'Addition', 'english');
INSERT INTO `chat_language` VALUES (201, 'goto', 'Go', 'english');
INSERT INTO `chat_language` VALUES (202, 'smiles', 'Smiles', 'english');
INSERT INTO `chat_language` VALUES (203, 'option', 'Parameters', 'english');
INSERT INTO `chat_language` VALUES (204, 'mail', 'Mail', 'english');
INSERT INTO `chat_language` VALUES (205, 'send', 'Send', 'english');
INSERT INTO `chat_language` VALUES (206, 'private', 'Private', 'english');
INSERT INTO `chat_language` VALUES (207, 'exit', 'Exit', 'english');
INSERT INTO `chat_language` VALUES (208, 'info', 'Info', 'english');
INSERT INTO `chat_language` VALUES (209, 'ignore', 'Ignore', 'english');
INSERT INTO `chat_language` VALUES (210, 'unignore', 'Unignore', 'english');
INSERT INTO `chat_language` VALUES (211, 'addwarn', 'Warn', 'english');
INSERT INTO `chat_language` VALUES (212, 'addcompl', 'To complain', 'english');
INSERT INTO `chat_language` VALUES (213, 'addban', 'Ban', 'english');
INSERT INTO `chat_language` VALUES (214, 'delban', 'Unban', 'english');
INSERT INTO `chat_language` VALUES (215, 'addban2', 'Add ban', 'english');
INSERT INTO `chat_language` VALUES (216, 'banlist', 'List of bans', 'english');
INSERT INTO `chat_language` VALUES (217, 'banlogs', 'Logs of bans', 'english');
INSERT INTO `chat_language` VALUES (218, 'rules', 'Rules', 'english');
INSERT INTO `chat_language` VALUES (219, 'clearmess', 'Clear messages', 'english');
INSERT INTO `chat_language` VALUES (220, 'refmess', 'Refresh messages', 'english');
INSERT INTO `chat_language` VALUES (221, 'myinfo', 'My information', 'english');
INSERT INTO `chat_language` VALUES (222, 'conpanel', 'Control panel', 'english');
INSERT INTO `chat_language` VALUES (223, 'newmess', 'New messages', 'english');
INSERT INTO `chat_language` VALUES (224, 'sendform', 'Form of the dispatch', 'english');
INSERT INTO `chat_language` VALUES (225, 'autofocus', 'Input line autofocus', 'english');
INSERT INTO `chat_language` VALUES (226, 'theme', 'Theme', 'english');
INSERT INTO `chat_language` VALUES (227, 'time', 'Time', 'english');
INSERT INTO `chat_language` VALUES (228, 'language', 'Language', 'english');
INSERT INTO `chat_language` VALUES (229, 'apply', 'Apply', 'english');
INSERT INTO `chat_language` VALUES (230, 'inbox', 'Inbox', 'english');
INSERT INTO `chat_language` VALUES (231, 'outbox', 'Outbox', 'english');
INSERT INTO `chat_language` VALUES (232, 'usemail', 'Used', 'english');
INSERT INTO `chat_language` VALUES (233, 'newletter', 'Write', 'english');
INSERT INTO `chat_language` VALUES (234, 'ups', 'up', 'english');
INSERT INTO `chat_language` VALUES (235, 'downs', 'down', 'english');
INSERT INTO `chat_language` VALUES (236, 'on', 'on', 'english');
INSERT INTO `chat_language` VALUES (237, 'off', 'off', 'english');
INSERT INTO `chat_language` VALUES (238, 'back', 'back', 'english');
INSERT INTO `chat_language` VALUES (239, 'myignlist', 'Ignored', 'english');
INSERT INTO `chat_language` VALUES (240, 'meignlist', 'Ignoring', 'english');
INSERT INTO `chat_language` VALUES (241, 'ttime|hms', 'H:M:S', 'english');
INSERT INTO `chat_language` VALUES (242, 'ttime|hm', 'H:M', 'english');
INSERT INTO `chat_language` VALUES (243, 'ttime|ms', 'M:S', 'english');
INSERT INTO `chat_language` VALUES (244, 'tstatus|free', 'Free', 'english');
INSERT INTO `chat_language` VALUES (245, 'tstatus|away', 'Away', 'english');
INSERT INTO `chat_language` VALUES (246, 'tstatus|na', 'Not available', 'english');
INSERT INTO `chat_language` VALUES (247, 'tstatus|dnd', 'Do not disturb', 'english');
INSERT INTO `chat_language` VALUES (248, 'notmess', 'You have not entered the text of the message!', 'english');
INSERT INTO `chat_language` VALUES (249, 'double', 'You were repeated...', 'english');
INSERT INTO `chat_language` VALUES (250, 'notnick', 'You have solved to write to itself?!', 'english');
INSERT INTO `chat_language` VALUES (251, 'administrator', 'Administartor', 'english');
INSERT INTO `chat_language` VALUES (252, 'moderator1', 'Senior moderator', 'english');
INSERT INTO `chat_language` VALUES (253, 'moderator2', 'Younger moderator', 'english');
INSERT INTO `chat_language` VALUES (254, 'user', 'User', 'english');
INSERT INTO `chat_language` VALUES (255, 'clear', 'Clear', 'english');
INSERT INTO `chat_language` VALUES (256, 'person', 'Personal messages', 'english');
INSERT INTO `chat_language` VALUES (257, 'touser', 'To whom', 'english');
INSERT INTO `chat_language` VALUES (258, 'fromuser', 'From whom', 'english');
INSERT INTO `chat_language` VALUES (259, 'when', 'When', 'english');
INSERT INTO `chat_language` VALUES (260, 'action', 'Action', 'english');
INSERT INTO `chat_language` VALUES (261, 'total', 'Total', 'english');
INSERT INTO `chat_language` VALUES (262, 'pages', 'Pages', 'english');
INSERT INTO `chat_language` VALUES (263, 'confirm', 'You really wish to remove this message?', 'english');
INSERT INTO `chat_language` VALUES (264, 'del', 'delete', 'english');
INSERT INTO `chat_language` VALUES (265, 'text', 'Text of message', 'english');
INSERT INTO `chat_language` VALUES (266, 'onsmiles', 'On smiles', 'english');
INSERT INTO `chat_language` VALUES (267, 'sendletter', 'Send', 'english');
INSERT INTO `chat_language` VALUES (268, 'b', 'b', 'english');
INSERT INTO `chat_language` VALUES (269, 'i', 'i', 'english');
INSERT INTO `chat_language` VALUES (270, 'u', 'u', 'english');
INSERT INTO `chat_language` VALUES (271, 'sup', 'sup', 'english');
INSERT INTO `chat_language` VALUES (272, 'sub', 'sub', 'english');
INSERT INTO `chat_language` VALUES (273, 'error|nick', 'You have not entered nick the addressee', 'english');
INSERT INTO `chat_language` VALUES (274, 'error|self', 'You send the message to yourselves', 'english');
INSERT INTO `chat_language` VALUES (275, 'error|theme', 'You have not entered a message theme', 'english');
INSERT INTO `chat_language` VALUES (276, 'error|text', 'You have not entered a message text', 'english');
INSERT INTO `chat_language` VALUES (277, 'error|tox', 'The addressee does not exist', 'english');
INSERT INTO `chat_language` VALUES (278, 'error|yourlimit', 'The limit of <b>your</b> personal messages is settled! Remove old messages and repeat sending', 'english');
INSERT INTO `chat_language` VALUES (279, 'error|tolimit', 'The limit of personal messages of the <b>addressee</b> is settled! Repeat sending later', 'english');
INSERT INTO `chat_language` VALUES (280, 'error|oldpass', 'The old password is not entered', 'english');
INSERT INTO `chat_language` VALUES (281, 'error|oldpass2', 'The old password is incorrectly entered', 'english');
INSERT INTO `chat_language` VALUES (282, 'error|passes', 'New and repeated passwords do not coincide', 'english');
INSERT INTO `chat_language` VALUES (283, 'error|mail', 'You have not entered e-mail', 'english');
INSERT INTO `chat_language` VALUES (284, 'error|mail2', 'You have entered incorrect e-mail', 'english');
INSERT INTO `chat_language` VALUES (285, 'error|mail3', 'The user with such e-mail is already registered', 'english');
INSERT INTO `chat_language` VALUES (286, 'error|about', 'You have not entered the information on', 'english');
INSERT INTO `chat_language` VALUES (287, 'error|path', 'The way is not specified', 'english');
INSERT INTO `chat_language` VALUES (288, 'error|image', 'The picture is not specified', 'english');
INSERT INTO `chat_language` VALUES (289, 'error|notfile', 'File empty', 'english');
INSERT INTO `chat_language` VALUES (290, 'error|ext', 'The file type will be <b>jpg</b>, <b>gif</b> or <b>png</b>', 'english');
INSERT INTO `chat_language` VALUES (291, 'error|width', 'The width of a picture is MORE than maximum allowable. The maximum width %s pixels', 'english');
INSERT INTO `chat_language` VALUES (292, 'error|height', 'The size of a picture is MORE than maximum allowable. The maximum height %s pixels', 'english');
INSERT INTO `chat_language` VALUES (293, 'error|size', 'The volume of a picture is MORE than maximum allowable. The maximum volume %s Kb', 'english');
INSERT INTO `chat_language` VALUES (294, 'error|small', 'Error at creation of the small copy of the image', 'english');
INSERT INTO `chat_language` VALUES (295, 'error|copy', 'Error at file loading on a server', 'english');
INSERT INTO `chat_language` VALUES (296, 'complete|send', 'The message is successfully sent!', 'english');
INSERT INTO `chat_language` VALUES (297, 'complete|sendx', 'There was an error at message departure!', 'english');
INSERT INTO `chat_language` VALUES (298, 'complete|error', 'There was an error!', 'english');
INSERT INTO `chat_language` VALUES (299, 'complete|copy', 'Copy the message', 'english');
INSERT INTO `chat_language` VALUES (300, 'complete|del', 'The message is successfully removed!', 'english');
INSERT INTO `chat_language` VALUES (301, 'complete|delx', 'There was an error at message removal!', 'english');
INSERT INTO `chat_language` VALUES (302, 'complete|load', 'File loading has passed successfully', 'english');
INSERT INTO `chat_language` VALUES (303, 'complete|errinfo', 'There was an error at information change', 'english');
INSERT INTO `chat_language` VALUES (304, 'complete|edit', 'The information is successfully changed', 'english');
INSERT INTO `chat_language` VALUES (305, 'complete|clearlogs', 'Broad gulls have been successfully cleared!', 'english');
INSERT INTO `chat_language` VALUES (306, 'complete|errlogs', 'There was an error at clarification of dens!', 'english');
INSERT INTO `chat_language` VALUES (307, 'im', 'I''m', 'english');
INSERT INTO `chat_language` VALUES (308, 'aboutuser', 'About the user', 'english');
INSERT INTO `chat_language` VALUES (309, 'about', 'About', 'english');
INSERT INTO `chat_language` VALUES (310, 'email', 'E-mail', 'english');
INSERT INTO `chat_language` VALUES (311, 'hidemail', 'Hide e-mail', 'english');
INSERT INTO `chat_language` VALUES (312, 'yes', 'Yes', 'english');
INSERT INTO `chat_language` VALUES (313, 'no', 'No', 'english');
INSERT INTO `chat_language` VALUES (314, 'photo', 'Photo', 'english');
INSERT INTO `chat_language` VALUES (315, 'actphoto', 'Active photo', 'english');
INSERT INTO `chat_language` VALUES (316, 'edit', 'Edit', 'english');
INSERT INTO `chat_language` VALUES (317, 'edit2', 'Edit', 'english');
INSERT INTO `chat_language` VALUES (318, 'notfound', 'Not found', 'english');
INSERT INTO `chat_language` VALUES (319, 'oldpass', 'Old password', 'english');
INSERT INTO `chat_language` VALUES (320, 'newpass', 'New password', 'english');
INSERT INTO `chat_language` VALUES (321, 'confpass', 'Confirm new pass', 'english');
INSERT INTO `chat_language` VALUES (322, 'cancel', 'Cancel', 'english');
INSERT INTO `chat_language` VALUES (323, 'nick', 'Nick', 'english');
INSERT INTO `chat_language` VALUES (324, 'ip', 'IP', 'english');
INSERT INTO `chat_language` VALUES (325, 'type', 'Type', 'english');
INSERT INTO `chat_language` VALUES (326, 'tban|1', 'To leave in a chat', 'english');
INSERT INTO `chat_language` VALUES (327, 'tban|2', 'To forbid access', 'english');
INSERT INTO `chat_language` VALUES (328, 'tban|3', 'To hammer windows', 'english');
INSERT INTO `chat_language` VALUES (329, 'reson', 'Reson', 'english');
INSERT INTO `chat_language` VALUES (330, 'btime|300', 'Ban for 5 minutes', 'english');
INSERT INTO `chat_language` VALUES (331, 'btime|900', 'Ban for 15 minutes', 'english');
INSERT INTO `chat_language` VALUES (332, 'btime|1800', 'Ban for 30 minutes', 'english');
INSERT INTO `chat_language` VALUES (333, 'btime|3600', 'Ban for 1 hour', 'english');
INSERT INTO `chat_language` VALUES (334, 'btime|5200', 'Ban for 2 hours', 'english');
INSERT INTO `chat_language` VALUES (335, 'btime|18000', 'Ban for 6 hours', 'english');
INSERT INTO `chat_language` VALUES (336, 'btime|43200', 'Ban for 12 hours', 'english');
INSERT INTO `chat_language` VALUES (337, 'btime|86400', 'Ban for 1 day', 'english');
INSERT INTO `chat_language` VALUES (338, 'btime|172800', 'Ban for 2 days', 'english');
INSERT INTO `chat_language` VALUES (339, 'btime|999999999', 'Ban for ~ minutes', 'english');
INSERT INTO `chat_language` VALUES (340, 'id', 'id', 'english');
INSERT INTO `chat_language` VALUES (341, 'moderator', 'Moder', 'english');
INSERT INTO `chat_language` VALUES (342, 'to', 'to', 'english');
INSERT INTO `chat_language` VALUES (343, 'addwarn2', 'To add the prevention', 'english');
INSERT INTO `chat_language` VALUES (344, 'addwarn3', 'To put the prevention for', 'english');
INSERT INTO `chat_language` VALUES (345, 'text2', 'The text <br> <small> no more than 60 symbols </small>', 'english');
INSERT INTO `chat_language` VALUES (346, 'clear2', 'clear all', 'english');
INSERT INTO `chat_language` VALUES (347, 'clear3', 'clear for this period', 'english');
INSERT INTO `chat_language` VALUES (348, 'view', 'look', 'english');
INSERT INTO `chat_language` VALUES (349, 'view2', 'look from', 'english');
INSERT INTO `chat_language` VALUES (350, 'months|1', 'january', 'english');
INSERT INTO `chat_language` VALUES (351, 'months|2', 'february', 'english');
INSERT INTO `chat_language` VALUES (352, 'months|3', 'march', 'english');
INSERT INTO `chat_language` VALUES (353, 'months|4', 'april', 'english');
INSERT INTO `chat_language` VALUES (354, 'months|5', 'may', 'english');
INSERT INTO `chat_language` VALUES (355, 'months|6', 'june', 'english');
INSERT INTO `chat_language` VALUES (356, 'months|7', 'july', 'english');
INSERT INTO `chat_language` VALUES (357, 'months|8', 'august', 'english');
INSERT INTO `chat_language` VALUES (358, 'months|9', 'september', 'english');
INSERT INTO `chat_language` VALUES (359, 'months|10', 'october', 'english');
INSERT INTO `chat_language` VALUES (360, 'months|11', 'november', 'english');
INSERT INTO `chat_language` VALUES (361, 'months|12', 'december', 'english');
INSERT INTO `chat_language` VALUES (362, 'colors|1', 'Black', 'english');
INSERT INTO `chat_language` VALUES (363, 'colors|2', 'Siena', 'english');
INSERT INTO `chat_language` VALUES (364, 'colors|3', 'Dark olive', 'english');
INSERT INTO `chat_language` VALUES (365, 'colors|4', 'Dark green', 'english');
INSERT INTO `chat_language` VALUES (366, 'colors|5', 'Sea', 'english');
INSERT INTO `chat_language` VALUES (367, 'colors|6', 'Indigo', 'english');
INSERT INTO `chat_language` VALUES (368, 'colors|7', 'Dark red', 'english');
INSERT INTO `chat_language` VALUES (369, 'colors|8', 'Dark orange', 'english');
INSERT INTO `chat_language` VALUES (370, 'colors|9', 'Olive', 'english');
INSERT INTO `chat_language` VALUES (371, 'colors|10', 'Green', 'english');
INSERT INTO `chat_language` VALUES (372, 'colors|11', 'Sea wave', 'english');
INSERT INTO `chat_language` VALUES (373, 'colors|12', 'Dark blue', 'english');
INSERT INTO `chat_language` VALUES (374, 'colors|13', 'Dim-grey', 'english');
INSERT INTO `chat_language` VALUES (375, 'colors|14', 'Red', 'english');
INSERT INTO `chat_language` VALUES (376, 'colors|15', 'Sandy', 'english');
INSERT INTO `chat_language` VALUES (377, 'colors|16', 'Salad', 'english');
INSERT INTO `chat_language` VALUES (378, 'colors|17', 'Turquoise', 'english');
INSERT INTO `chat_language` VALUES (379, 'colors|18', 'Purple', 'english');
INSERT INTO `chat_language` VALUES (380, 'colors|19', 'Grey', 'english');
INSERT INTO `chat_language` VALUES (381, 'colors|20', 'Crimson', 'english');
INSERT INTO `chat_language` VALUES (382, 'colors|21', 'Orange', 'english');
INSERT INTO `chat_language` VALUES (383, 'colors|22', 'Yellow', 'english');
INSERT INTO `chat_language` VALUES (384, 'colors|23', 'Lime', 'english');
INSERT INTO `chat_language` VALUES (385, 'colors|24', 'Blue', 'english');
INSERT INTO `chat_language` VALUES (386, 'colors|25', 'Sky blue', 'english');
INSERT INTO `chat_language` VALUES (387, 'colors|26', 'Silvery', 'english');
INSERT INTO `chat_language` VALUES (388, 'colors|27', 'Pink', 'english');
INSERT INTO `chat_language` VALUES (389, 'colors|28', 'Pale-green', 'english');
INSERT INTO `chat_language` VALUES (390, 'colors|29', 'Plum', 'english');

DROP TABLE IF EXISTS `chat_logs`;
CREATE TABLE `chat_logs` (
  `id` int(11) NOT NULL auto_increment,
  `user` varchar(50) NOT NULL default '',
  `moder` varchar(50) NOT NULL default '',
  `text` text NOT NULL,
  `time` int(30) NOT NULL default '0',
  PRIMARY KEY  (`id`)
);


DROP TABLE IF EXISTS `chat_mail`;
CREATE TABLE `chat_mail` (
  `id` int(11) NOT NULL auto_increment,
  `user` varchar(50) NOT NULL default '',
  `userto` varchar(50) NOT NULL default '',
  `time` int(30) NOT NULL default '0',
  `theme` varchar(255) NOT NULL default '',
  `text` text NOT NULL,
  `rd` int(1) NOT NULL default '0',
  `viewin` enum('0','1') NOT NULL default '0',
  `viewout` enum('0','1') NOT NULL default '0',
  PRIMARY KEY  (`id`)
);

DROP TABLE IF EXISTS `chat_messages`;
CREATE TABLE `chat_messages` (
  `id` int(11) NOT NULL auto_increment,
  `room` int(10) NOT NULL default '0',
  `user` varchar(50) NOT NULL default '',
  `userto` varchar(50) NOT NULL default '',
  `time` int(50) NOT NULL default '0',
  `message` text NOT NULL,
  `private` enum('0','1') NOT NULL default '0',
  `color` varchar(30) NOT NULL default '#000000',
  PRIMARY KEY  (`id`)
);

DROP TABLE IF EXISTS `chat_onliners`;
CREATE TABLE `chat_onliners` (
  `id` int(11) NOT NULL auto_increment,
  `user` varchar(50) NOT NULL default '',
  `room` int(11) NOT NULL default '0',
  `balls` int(3) NOT NULL default '0',
  `ip` varchar(15) NOT NULL default '0.0.0.0',
  `sid` varchar(255) NOT NULL default '',
  `lastactivity` int(50) NOT NULL default '0',
  `status` varchar(10) NOT NULL default 'free',
  `ban` int(1) NOT NULL default '0',
  `lang` varchar(255) NOT NULL default '',
  `upd` int(30) default '0',
  PRIMARY KEY  (`id`)
);

DROP TABLE IF EXISTS `chat_rooms`;
CREATE TABLE `chat_rooms` (
  `id` int(11) NOT NULL auto_increment,
  `name` varchar(50) NOT NULL default '',
  `botname` varchar(50) NOT NULL default '���������',
  PRIMARY KEY  (`id`)
);

INSERT INTO `chat_rooms` VALUES (1, '�����', '���������');
INSERT INTO `chat_rooms` VALUES (2, '���������', '���������');

DROP TABLE IF EXISTS `chat_rules`;
CREATE TABLE `chat_rules` (
  `id` int(11) NOT NULL auto_increment,
  `id_cat` int(11) NOT NULL default '0',
  `content` text NOT NULL,
  PRIMARY KEY  (`id`)
);

INSERT INTO `chat_rules` VALUES (1, 1, '������������ �������� ������������ ��� ������� � ���. \r\n');
INSERT INTO `chat_rules` VALUES (2, 1, '�������� "�� �����" ������ �����������, ������� ����.\r\n');
INSERT INTO `chat_rules` VALUES (3, 2, '�� ����������� ���� � �� �� ����� ����� 3� ��� ������, �� ���������� ������ �� ������ �������������. \r\n');
INSERT INTO `chat_rules` VALUES (4, 2, '������������� ��������, ��� ��� ��������� ������ � ������� ������ ������ ����� ������������.(�������� - 8 �������). \r\n');
INSERT INTO `chat_rules` VALUES (5, 2, '������������ ��� �������������� ��������� � �������������� ������������. \r\n');
INSERT INTO `chat_rules` VALUES (6, 2, '������������ ��������� �������������� ������ ���������.\r\n');
INSERT INTO `chat_rules` VALUES (7, 3, '������ �� ����� (�� ������������� ������ ����������) �������. ������� �������� � ���������� ��������������! ');
INSERT INTO `chat_rules` VALUES (8, 3, '�� ���������� ����������� ��������� �������������, ��������, �������� � �.�. \r\n');
INSERT INTO `chat_rules` VALUES (9, 4, '���������� ������������ ���� ������ ���������� � ��� �������������. \r\n');
INSERT INTO `chat_rules` VALUES (10, 4, '������������ ������������� ������� � ����������, �������������� ���. \r\n');
INSERT INTO `chat_rules` VALUES (11, 4, '���������� � ������ ������������. \r\n');
INSERT INTO `chat_rules` VALUES (12, 4, '�� �������������� ��������� �������� ���������, ��� ������� ���� ������. ');
INSERT INTO `chat_rules` VALUES (13, 4, '����������� ����� ������ ���������� � �������������, ��� �������� ����� �������� (�������� ���, ����� ����������, �������, ����� ������ � �.�.) \r\n');
INSERT INTO `chat_rules` VALUES (14, 4, '��� ��� �������� �����������, ������� � ���� ��������� ������������ ��������, ����� ��������������� ������, ������� �������, � ��� ����� � ���������, ���������, ������������ ������, �������� � �.�. \r\n');
INSERT INTO `chat_rules` VALUES (15, 4, '���������� ����������: �������, �����������, �� ����������� ����������, ������� ��������������, ��� ������ ���������. \r\n');
INSERT INTO `chat_rules` VALUES (16, 4, '���������� ������� � ������������ ����������. \r\n');
INSERT INTO `chat_rules` VALUES (17, 4, '����������� ������ ������� � ���� �������� �������. ����������� transliteratsija. ��������� ����� ������������, �������, �����, �� � ����� �������� ��������. �� ��������������� ���.\r\n');
INSERT INTO `chat_rules` VALUES (18, 5, '��������� ��������, ������� ����� � ���� ��������� ���������������� ��.');
INSERT INTO `chat_rules` VALUES (19, 5, '����� �������� �������, ����� ���������, ������ � ������� � �������������� �/��� ����������� �����. \r\n');
INSERT INTO `chat_rules` VALUES (20, 5, '������ ������� � ����������� ���� ��� ������� �������� � ����������.\r\n');
INSERT INTO `chat_rules` VALUES (21, 6, '������� ����� (������ ��� ��������� ������������� ����� ����� ������������������ ����� � ����). \r\n');
INSERT INTO `chat_rules` VALUES (22, 6, '������������ ���� - ����, ������� ����� ���� ����������������, ��� ��������� ����� � ����������� �������������� � �� �������������� �������������, � ����� ��������� �����, ������� ����� �� ����� ��������� � ����. \r\n');
INSERT INTO `chat_rules` VALUES (23, 6, '���������� � ���� �������. \r\n');
INSERT INTO `chat_rules` VALUES (24, 6, '������� ����� � ��� ����� ���� ��� ������ �����. \r\n');
INSERT INTO `chat_rules` VALUES (25, 6, '�������� ����� ��� ����� ������.\r\n');
INSERT INTO `chat_rules` VALUES (26, 7, '����� ���� ����������� (������������ ��������������). \r\n');
INSERT INTO `chat_rules` VALUES (27, 7, '������������ ����� ������������ ��� (�� ���� ������ ��������� � ��� ������ ����� ������������� ��������� ��� �����). \r\n');
INSERT INTO `chat_rules` VALUES (28, 7, '�������� ������������� ��������� � ���������� � �������� ������ ����.\r\n');
INSERT INTO `chat_rules` VALUES (29, 7, '����������� ������ ������ �����������, � ������� ���������� ������ ������.');

DROP TABLE IF EXISTS `chat_rules_cats`;
CREATE TABLE `chat_rules_cats` (
  `id` int(11) NOT NULL auto_increment,
  `categ` text NOT NULL,
  PRIMARY KEY  (`id`)
);

INSERT INTO `chat_rules_cats` VALUES (1, '�������� ���������� ���������������� ����.');
INSERT INTO `chat_rules_cats` VALUES (2, '����');
INSERT INTO `chat_rules_cats` VALUES (3, '�������');
INSERT INTO `chat_rules_cats` VALUES (4, '���, �����������, ����, �����������');
INSERT INTO `chat_rules_cats` VALUES (5, '������ ��');
INSERT INTO `chat_rules_cats` VALUES (6, '���� (��������)');
INSERT INTO `chat_rules_cats` VALUES (7, '����������');

DROP TABLE IF EXISTS `chat_smiles`;
CREATE TABLE `chat_smiles` (
  `id` int(10) NOT NULL auto_increment,
  `code` varchar(50) default NULL,
  `url` varchar(45) NOT NULL default '',
  PRIMARY KEY  (`id`),
  UNIQUE KEY `code` (`code`)
);

INSERT INTO `chat_smiles` VALUES (1, ':$', '17.gif');
INSERT INTO `chat_smiles` VALUES (2, ':)', 'ab.gif');
INSERT INTO `chat_smiles` VALUES (3, ':(', 'ac.gif');
INSERT INTO `chat_smiles` VALUES (4, ';)', 'ad.gif');
INSERT INTO `chat_smiles` VALUES (5, ':*', 'aj.gif');
INSERT INTO `chat_smiles` VALUES (6, '@=', 'bb.gif');
INSERT INTO `chat_smiles` VALUES (7, '%)', 'be.gif');
INSERT INTO `chat_smiles` VALUES (8, ':-p', '11.gif');
INSERT INTO `chat_smiles` VALUES (9, ':-(', '26.gif');
INSERT INTO `chat_smiles` VALUES (10, ':-)', '3.gif');
INSERT INTO `chat_smiles` VALUES (11, ':-D', '15.gif');
INSERT INTO `chat_smiles` VALUES (12, ':-*', '24.gif');
INSERT INTO `chat_smiles` VALUES (13, ':^(', '9.gif');
INSERT INTO `chat_smiles` VALUES (14, '~:(', '16.gif');
INSERT INTO `chat_smiles` VALUES (15, '0:)', '27.gif');
INSERT INTO `chat_smiles` VALUES (16, ':p,', 'ae.gif');
INSERT INTO `chat_smiles` VALUES (17, '8-)', 'af.gif');
INSERT INTO `chat_smiles` VALUES (18, ':-[', 'ah.gif');
INSERT INTO `chat_smiles` VALUES (19, '=-O', 'ai.gif');
INSERT INTO `chat_smiles` VALUES (20, ':`(', 'ak.gif');
INSERT INTO `chat_smiles` VALUES (21, ':-X', 'al.gif');
INSERT INTO `chat_smiles` VALUES (22, ':-/', 'ao.gif');
INSERT INTO `chat_smiles` VALUES (23, '/m/', 'bd.gif');
INSERT INTO `chat_smiles` VALUES (24, ':-((', '14.gif');
INSERT INTO `chat_smiles` VALUES (25, '[:-}', 'ar.gif');
INSERT INTO `chat_smiles` VALUES (26, '*OK*', 'bf.gif');
INSERT INTO `chat_smiles` VALUES (27, '*HI*', 'bo.gif');
INSERT INTO `chat_smiles` VALUES (28, '*OPOP*', 'cr.gif');
INSERT INTO `chat_smiles` VALUES (29, '!love', '12.gif');
INSERT INTO `chat_smiles` VALUES (30, '*SUP*', 'bg.gif');
INSERT INTO `chat_smiles` VALUES (31, '*UGU*', 'bx.gif');
INSERT INTO `chat_smiles` VALUES (32, '*NEA*', 'by.gif');
INSERT INTO `chat_smiles` VALUES (33, '*AHZ*', 'cd.gif');
INSERT INTO `chat_smiles` VALUES (34, '*YES*', 'cm.gif');
INSERT INTO `chat_smiles` VALUES (35, '*VKZ*', 'cl.gif');
INSERT INTO `chat_smiles` VALUES (36, '*STOP*', 'av.gif');
INSERT INTO `chat_smiles` VALUES (37, '@}-&gt;--', 'ax.gif');
INSERT INTO `chat_smiles` VALUES (38, '*BUBA*', 'bk.gif');
INSERT INTO `chat_smiles` VALUES (39, '*THIS*', 'ce.gif');
INSERT INTO `chat_smiles` VALUES (40, '*OPPA*', 'cg.gif');
INSERT INTO `chat_smiles` VALUES (41, '*POKA*', 'cf.gif');
INSERT INTO `chat_smiles` VALUES (42, '*RTMF*', 'ci.gif');
INSERT INTO `chat_smiles` VALUES (43, '*TUTU*', 'ch.gif');
INSERT INTO `chat_smiles` VALUES (44, '*XEXE*', 'co.gif');
INSERT INTO `chat_smiles` VALUES (45, '*amazed*', '7.gif');
INSERT INTO `chat_smiles` VALUES (46, '*BRAVO*', 'bi.gif');
INSERT INTO `chat_smiles` VALUES (47, '*SLEEP*', 'br.gif');
INSERT INTO `chat_smiles` VALUES (48, '*DANCE*', 'bg.gif');
INSERT INTO `chat_smiles` VALUES (49, '*SCARE*', 'bt.gif');
INSERT INTO `chat_smiles` VALUES (50, '*VREPU*', 'bu.gif');
INSERT INTO `chat_smiles` VALUES (51, '*KATIT*', 'bz.gif');
INSERT INTO `chat_smiles` VALUES (52, '*ISHTY*', 'cc.gif');
INSERT INTO `chat_smiles` VALUES (53, '*ZABEY*', 'cb.gif');
INSERT INTO `chat_smiles` VALUES (54, '*PASIB*', 'ck.gif');
INSERT INTO `chat_smiles` VALUES (55, '*KISSED*', 'as.gif');
INSERT INTO `chat_smiles` VALUES (56, '*SATANA*', 'bn.gif');
INSERT INTO `chat_smiles` VALUES (57, '*SECRET*', 'bs.gif');
INSERT INTO `chat_smiles` VALUES (58, '*FITFIT*', 'cq.gif');
INSERT INTO `chat_smiles` VALUES (59, '*KISSING*', 'aw.gif');
INSERT INTO `chat_smiles` VALUES (60, '*IN LOVE*', 'ba.gif');
INSERT INTO `chat_smiles` VALUES (61, '*RUSSIAN*', 'bj.gif');
INSERT INTO `chat_smiles` VALUES (62, '*NEKATIT*', 'ca.gif');
INSERT INTO `chat_smiles` VALUES (63, '*VICTORY*', 'cj.gif');
INSERT INTO `chat_smiles` VALUES (64, '*THUMBS UP', 'ay.gif');

DROP TABLE IF EXISTS `chat_users`;
CREATE TABLE `chat_users` (
  `id` int(11) NOT NULL auto_increment,
  `user` varchar(50) NOT NULL default '',
  `pass` varchar(255) NOT NULL default '',
  `balls` int(3) NOT NULL default '0',
  `mail` varchar(70) NOT NULL default '',
  `about` text NOT NULL,
  `skin` varchar(50) NOT NULL default 'default',
  `smiles` enum('0','1') NOT NULL default '1',
  `nm` enum('up','down') NOT NULL default 'down',
  `send` enum('up','down') NOT NULL default 'down',
  `time` enum('hm','ms','hms') NOT NULL default 'hm',
  `focus` enum('0','1') NOT NULL default '1',
  `lang` varchar(50) NOT NULL default 'russian',
  `hidemail` enum('0','1') NOT NULL default '0',
  PRIMARY KEY  (`id`)
);