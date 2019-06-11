drop database Slack;
create database Slack;
use Slack;

create table User (
    uid int auto_increment primary key,
    email varchar(30),
    password varchar(20),
    username varchar(30),
    nickname varchar(20)
);

create table Workspace (
    wid int auto_increment primary key,
    wname varchar(20),
    description varchar(50),
    wcreatorId int,
    wcreateTime datetime,
    foreign key (wcreatorId) references User(uid)
);

create table Channel (
    cid int auto_increment primary key,
    wid int,
    channelName varchar(20),
    ctype enum('public', 'private', 'direct'),
    ccreatorId int,
    ccreateTime datetime,
    foreign key (wid) references Workspace(wid),
    foreign key (ccreatorId) references User(uid)
);

create table Message (
    mid int auto_increment primary key,
    cid int,
    mtype enum('text', 'image', 'hyperlink', 'emoji', 'rich text makeup'),
    fromId int,
    content varchar(100),
    messageTime datetime,
    foreign key (cid) references Channel(cid),
    foreign key (fromId) references User(uid)
);

create table UseWorkspace (
    wid int, 
    uid int,
    wjointime datetime,
    primary key (wid, uid),
    foreign key (uid) references User(uid),
    foreign key (wid) references Workspace(wid)
);

create table UseChannel(
    cid int,
    uid int,
    cjointime datetime,
    primary key (cid, uid),
    foreign key (uid) references User(uid),
    foreign key (cid) references Channel(cid)
);

create table Administration(
	wid int,
	uid int,
    ajointime datetime,
    primary key (wid, uid),
    foreign key (uid) references User(uid),
    foreign key (wid) references Workspace(wid)
);

create table Invitation(
	fromId int,
    toId int,
    type varchar(20),
    id int,
    inviteTime datetime,
    viewed varchar(3),
    accepted varchar(3),
	primary key (fromId, toId, type, id, inviteTime),
	foreign key (fromId) references User(uid),
    foreign key (toId) references User(uid)
);

