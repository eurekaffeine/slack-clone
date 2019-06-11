use slack;

insert into User(uid, username, nickname, password, email) values
(1, "Ezio Auditore", "Ezio", "1234567890", "eizo@gmail.com"),
(2, "Connor Kenway", "Connor", "1234567890", "connor@gmail.com"),
(3, "Jacob Frye", "Jacob", "1234567890", "Jacob@gmail.com"),
(4, "Evie Frye", "Evie", "1234567890", "Evie@gmail.com"),
(5, "Bayek", "Bay", "1234567890", "bayek@outlook.com"),
(6, "Kassandra", "Kass", "1234567890", "kass@yahoo.com"),
(7, "Shao Jun", 'Shao', "1234567890", "shaojun@163.com")
;

insert into Workspace(wid, wname, description, wcreatorId, wcreateTime) values
(1, "1stWork", "This is the 1st Workspace", 1, "2018-12-08 10:00:00"),
(2, "2stWork", "This is the 2nd Workspace", 2, "2019-01-08 10:00:00"),
(3, "3stWork", "This is the 3rd Workspace", 3, "2019-02-08 10:00:00"),
(4, "4thWork", "This is the 4th Workspace", 1, "2019-04-08 10:00:00"),
(5, "5thWork", "This is the 5th Workspace", 5, "2018-12-08 10:00:00"),
(6, "6thWork", "This is the 6th Workspace", 2, "2019-12-08 10:00:00"),
(7, "GoogleWork", "This is the 7th Workspace", 2, "2019-2-08 10:00:00")
;


insert into UseWorkspace(wid, uid, wjointime) values
(1, 1, "2018-12-08 10:00:00"),
(1, 2, "2018-12-08 11:06:00"),
(1, 3, "2018-12-08 12:05:00"),
(1, 4, "2018-12-08 13:04:00"),
(2, 2, "2019-01-08 10:00:00"),
(2, 3, "2018-01-08 11:02:00"),
(2, 4, "2018-01-08 12:01:00"),
(3, 3, "2019-02-08 10:00:00"),
(3, 4, "2019-02-09 10:20:00"),
(4, 1, "2019-04-08 10:00:00"),
(5, 5, "2018-12-08 10:00:00"),
(5, 1, "2018-12-08 19:05:00"),
(5, 2, "2018-12-08 21:00:00"),
(6, 2, "2019-12-08 10:00:00")
;

insert into Channel(cid, wid, channelName, ctype, ccreatorId, ccreateTime) values 
(1, 1, "Google", "public", 1, "2018-12-08 11:00:00"),
(2, 2, "Facebook", "public", 2, "2019-01-08 12:00:00"),
(3, 3, "Amazon", "public", 3, "2019-01-08 12:00:00"),
(4, 2, "LinkedIn", "private", 2, "2019-03-08 10:00:00"),
(5, 1, "FLAG", "direct", 1, "2019-04-02 12:00:00"),
(6, 5, "OFFER", "public", 5, "2019-04-01 12:00:00")
;
insert into Invitation(fromId, toId, type, id, inviteTime, viewed, accepted, deleted) values
(2, 1, 'workspace', 2, "2018-12-08 11:00:00", 'NO', 'NO'),
(2, 1, 'workspace', 3, "2018-12-08 12:00:00", 'NO', 'NO'),
(1, 4, 'workspace', 1, "2018-12-08 13:00:00", 'NO', 'NO'),
(2, 3, 'workspace', 2, "2018-01-08 11:00:00", 'NO', 'NO'),
(2, 4, 'workspace', 2, "2018-01-08 12:00:00", 'NO', 'NO'),
(3, 4, 'workspace', 3, "2019-02-09 10:00:00", 'NO', 'NO'),
(3, 7, 'workspace', 3, "2019-02-09 11:00:00", 'NO', 'NO'),
(5, 1, 'workspace', 5, "2018-12-08 19:00:00", 'NO', 'NO'),
(5, 2, 'workspace', 5, "2018-12-08 20:00:00", 'NO', 'NO'),
(2, 1, 'channel', 2, "2018-12-08 11:00:00", 'NO', 'NO'),
(2, 1, 'channel', 3, "2018-12-08 12:00:00", 'NO', 'NO'),
(1, 4, 'channel', 1, "2018-12-08 13:00:00", 'NO', 'NO'),
(2, 3, 'channel', 2, "2018-01-08 11:00:00", 'NO', 'NO'),
(2, 4, 'channel', 2, "2018-01-08 12:00:00", 'NO', 'NO'),
(3, 4, 'channel', 3, "2019-02-09 10:00:00", 'NO', 'NO'),
(3, 7, 'channel', 3, "2019-02-09 11:00:00", 'NO', 'NO'),
(5, 1, 'channel', 5, "2018-12-08 19:00:00", 'NO', 'NO'),
(5, 2, 'channel', 5, "2018-12-08 20:00:00", 'NO', 'NO'),
(2, 1, 'administration', 3, "2019-02-09 10:00:00", 'NO', 'NO'),
(3, 7, 'administration', 3, "2019-02-09 11:00:00", 'NO', 'NO'),
(5, 1, 'administration', 5, "2018-12-08 19:00:00", 'NO', 'NO'),
(5, 2, 'administration', 5, "2018-12-08 20:00:00", 'NO', 'NO')
;

insert into UseChannel(cid, uid, cjointime) values
(1, 1, "2018-12-08 11:00:00"),
(1, 2, "2018-12-08 11:20:00"),
(1, 3, "2019-01-08 13:00:00"),
(2, 2, "2019-01-08 12:00:00"),
(2, 3, "2019-01-08 13:55:00"),
(2, 4, "2019-01-08 16:45:00"),
(3, 3, "2019-01-08 12:00:00"),
(4, 2, "2019-01-08 12:00:00"),
(4, 3, "2019-03-08 19:40:00"),
(5, 1, "2019-04-02 12:00:00"),
(5, 2, "2019-04-03 22:35:00"),
(6, 5, "2019-04-01 12:00:00"),
(6, 2, "2019-04-01 14:59:50")
;

insert into Message(mid, cid, mtype, fromId, content, messageTime) values 
(1, 1, "text", 1, "perpendicular can be viewed by 1, 2, 3", "2019-03-08 15:00:00"),
(2, 1, "text", 2, "perpendicular can be viewed by 1, 2, 3", "2019-03-08 15:01:01"),
(3, 1, "text", 3, "perpendicular can be viewed by 1, 2, 3", "2019-03-08 15:09:01"),
(4, 2, "text", 2, "perpendicular can be viewed by 2, 3", "2019-01-08 13:59:01"),
(5, 2, "text", 3, "Nothing", "2019-04-08 17:02:01"),
(6, 2, "text", 4, "Nice to meet you.", "2019-04-08 17:05:06"),
(7, 3, "text", 3, "Only uid3 in c3", "2019-04-09 19:23:23"),
(8, 4, "text", 2, "Hello u3", "2019-04-09 19:23:29"),
(9, 4, "text", 3, "Hello u2", "2019-04-09 19:24:23"),
(10, 5, "hyperlink", 2, "www.google.com", "2019-04-10 19:24:23"),
(11, 6, "text", 5, "perpendicular can be viewed by 2, 5", "2019-04-12 19:24:23")
;

