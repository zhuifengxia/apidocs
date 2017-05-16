-- phpMyAdmin SQL Dump
-- version 4.0.5
-- http://www.phpmyadmin.net
--
-- 主机: localhost
-- 生成日期: 2014 年 06 月 17 日 17:46
-- 服务器版本: 5.00.15
-- PHP 版本: 5.3.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- 数据库: `medicoolapidocs`
--

-- --------------------------------------------------------

--
-- 表的结构 `medi_api`
--

CREATE TABLE IF NOT EXISTS `medi_api` (
  `Medi_ApiID` int(11) NOT NULL auto_increment COMMENT '接口自增ID',
  `Medi_ApiName` varchar(50) default NULL COMMENT '接口名称',
  `Medi_ApiBelongs` varchar(50) default NULL COMMENT '接口所属模块',
  `Medi_ApiCreateName` varchar(50) default NULL COMMENT '接口编写人',
  `Medi_ApiCreateTime` datetime default NULL COMMENT '接口创建时间',
  `Medi_ApiUpdateTime` datetime default NULL COMMENT '接口修改时间',
  `Medi_ApiUpdateName` varchar(50) default NULL COMMENT '接口修改人',
  `Medi_ApiAction` text COMMENT '接口作用',
  `Medi_ApiUrl` varchar(300) default NULL COMMENT '接口实例地址',
  `Medi_ApiFormat` varchar(100) default NULL COMMENT '接口支持格式',
  `Medi_ApiRequest` varchar(100) default NULL COMMENT '接口请求方式',
  `Medi_ApiResult` text COMMENT '接口返回结果',
  `Medi_InterfaceID` int(11) default NULL COMMENT '接口所属接口文档ID',
  PRIMARY KEY  (`Medi_ApiID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='接口表' AUTO_INCREMENT=16 ;

--
-- 转存表中的数据 `medi_api`
--

INSERT INTO `medi_api` (`Medi_ApiID`, `Medi_ApiName`, `Medi_ApiBelongs`, `Medi_ApiCreateName`, `Medi_ApiCreateTime`, `Medi_ApiUpdateTime`, `Medi_ApiUpdateName`, `Medi_ApiAction`, `Medi_ApiUrl`, `Medi_ApiFormat`, `Medi_ApiRequest`, `Medi_ApiResult`, `Medi_InterfaceID`) VALUES
(1, '手机端登陆接口', '用户中心', '刘单风', '2014-05-27 09:11:22', '2014-06-17 12:43:36', '刘单风', '根据用户传递过来的账号密码实现软件登录', 'http://www.meditool.cn/Apiuserv2/login?UserName={string}&UserPassword={string}', 'json数据返回', 'GET/POST', '{"status":0,"msg":"登陆成功","data":{"user_id":"1","username":"admin","usertoken":"0777e17304092a1d14239592c8576201"}}', 1),
(2, '普通注册接口', '用户中心', '刘单风', '2014-06-14 20:34:22', '2014-06-17 13:04:50', '刘单风', '根据用户传递过来的用户名密码以及推广人完成用户注册', 'http://www.meditool.cn/Apiuserv2/register?UserName={string}&UserPassword={string}&webinviter={string}', 'JSON', 'GET/POST', '{"status":0,"msg":"and insert bone data success","data":{"user_id":"3551","usertoken":"ad930c27dceab44c629c7c7917f481e8","username":"2222"}}', 1),
(3, 'PC端登陆接口', '用户中心', '刘单风', '2014-06-14 20:40:24', '2014-06-17 12:51:27', '刘单风', '根据pc端传递过来的账号信息实现用户登陆', 'http://www.meditool.cn/Apiuserv2/login2?UserName={string}&UserPassword={string}', 'json返回', 'GET/POST', '{"status":0,"msg":"登陆成功","data":{"user_id":"1093","username":"tzj123","accessKey":"btozm8TpB8D3Hb3WJjU1QThPbj7JqIjHQdagm-GP","secretKey":"jd1ScJpmnhARJW1f_WsNs-CNbRpejXnl-Y9Qt3RX","usertoken":"222aa13446188c759a3749c3019b968b"}}', 1),
(4, '发送验证码接口', '用户中心', '刘单风', '2014-06-17 13:42:01', '2014-06-17 13:42:01', '刘单风', '根据手机端填写的手机号码，向该手机发送验证码', 'http://meditool.cn/Apiuserv2/sendphonecode?phone={string}', 'JSON', 'GET/POST', '{"status":0,"msg":"send success"}', 1),
(5, '手机注册接口', '用户中心', '刘单风', '2014-06-17 13:54:12', '2014-06-17 13:57:07', '刘单风', '根据手机号以及验证码完成用户注册', 'http://www.meditool.cn/Apiuserv2/phoneregcode?userphone={string}&phonecode={string}&phonepwd={string}', 'JSON', 'GET/POST', '{"status":0,"msg":"and insert bone data success","data":{"user_id":"3551","usertoken":"ad930c27dceab44c629c7c7917f481e8","username":"2222"}}', 1),
(6, '保存游戏分数接口', '用户中心', '刘单风', '2014-06-17 14:25:45', '2014-06-17 14:25:45', '刘单风', '根据用户传递过来的游戏分数以及地理位置所在科室保存数据信息', 'http://www.meditool.cn/Apiuserv2/savegamescord?userid={int}&userlocation={string}&userscord={string}&usercorrect={string}&userdep={string}&usertoken={string}', 'JSON', 'GET/POST', '{"status":0,"msg":"success"}', 1),
(7, '游戏得分排行榜接口', '用户中心', '刘单风', '2014-06-17 15:40:18', '2014-06-17 15:40:18', '刘单风', '获取游戏得分前十', 'http://www.meditool.cn/Apiuserv2/getgametop?userid={int}&usertoken={string}', 'JSON', 'GET/POST', '{"status":0,"msg":"success","data":[{"UserName":"admin","UserScore":"100","UserLocation":null},{"UserName":"crazy1982","UserScore":"98","UserLocation":null},{"UserName":"pyw210","UserScore":"95","UserLocation":null},{"UserName":"athlon1g","UserScore":"93","UserLocation":null},{"UserName":"pyw210","UserScore":"92","UserLocation":null},{"UserName":"\\u65e0\\u654c","UserScore":"91","UserLocation":null},{"UserName":"athlon1g","UserScore":"88","UserLocation":null},{"UserName":"absonoRub","UserScore":"86","UserLocation":null},{"UserName":"athlon1g","UserScore":"80","UserLocation":null},{"UserName":"Zhangxifeng","UserScore":"75","UserLocation":null}]}', 1),
(8, '用户完善信息接口', '用户中心', '刘单风', '2014-06-17 15:48:17', '2014-06-17 15:48:17', '刘单风', '根据用户传递过来的详细信息数据实现数据保存', 'http://www.meditool.cn/Apiuserv2/userdetails?userid={int}&useremail={string}&usertype={int}&userdep={string}&userinterest={string}&usertoken={string}&calltype={int}', 'JSON', 'GET/POST', '{"status":0,"msg":"success"}', 1),
(9, '修改密码接口', '用户中心', '刘单风', '2014-06-17 15:50:22', '2014-06-17 15:53:09', '刘单风', '用户修改密码', 'http://www.meditool.cn/Apiuserv2/updatepwd?UserID={int}&UserPassword={string}&usertoken={string}&calltype={int}', 'JSON', 'GET/POST', '{"status":0,"msg":"success"}', 1),
(10, '医学网站同步注册接口', '用户中心', '刘单风', '2014-06-17 16:02:05', '2014-06-17 16:02:05', '刘单风', '医学网站注册用户同时同步到珍立拍数据库', 'http://www.meditool.cn/Apiuserv2/registerskin?UserName={string}&UserPassword={string}&UserEmail={string}&usertoken={string}', 'JSON', 'GET/POST', '{"status":0,"msg":"success"}', 1),
(11, '医学网站查询接口', '用户中心', '刘单风', '2014-06-17 16:17:41', '2014-06-17 16:17:41', '刘单风', '查询传递过来的用户是否是珍立拍用户', 'http://www.meditool.cn/Apiuserv2/cheregister?UserName={string}&UserPassword={string}&usertoken={string}', 'JSON', 'GET/POST', '{"status":2,"msg":"you"}', 1),
(12, '医学网站修改密码同步接口', '用户中心', '刘单风', '2014-06-17 16:22:25', '2014-06-17 16:22:25', '刘单风', '医学网站修改密码同步到珍立拍数据库中', 'http:www.meditool.cn/Apiuserv2/boneskinupwd?username={string}&userpwd={string}&usertoken={string}', 'JSON', 'GET/POST', '{"status":0,"msg":"success"}', 1),
(13, '问题反馈接口', '用户中心', '刘单风', '2014-06-17 16:33:52', '2014-06-17 16:33:52', '刘单风', '用户对于该产品提出的一些建议及问题等反馈信息的处理', 'http://www.meditool.cn/Apiuserv2/websitetickling?userid={}&ticklingtype={string}&ticklingcontent={string}&linkemail={string}&usertoken={string}&calltype={int}', 'JSON', 'GET/POST', '{"status":0,"msg":"success"}', 1),
(14, 'Token是否有效接口', '用户中心', '刘单风', '2014-06-17 16:41:40', '2014-06-17 16:41:40', '刘单风', '根据用户ID得到用户token查询token是否过期', 'http://www.meditool.cn/Apiuserv2/seltokenbyid?userid={int}&usertoken={string}&calltype={int}', 'JSON', 'GET/POST', '{"status":0,"msg":"success"}', 1),
(15, '获取用户详细数据', '用户中心', '刘单风', '2014-06-17 17:42:32', '2014-06-17 17:42:32', '刘单风', '根据 用户ID得到用户详细数据信息', 'http://www.meditool.cn/Apiuserv2/getuserdetail?userid={int}&usertoken={string}&calltype={int}', 'JSON', 'GET/POST', '{"status":0,"msg":"select success","data":{"UserID":"1093","UserName":"tzj123","UserPsw":"7c4a8d09ca3762af61e59520943dc26494f8941b","FullName":"\\u6d4b\\u8bd5\\u8d26\\u53f7","PatientCount":"1","ProjectCount":"42","UserLevel":"3","IDCard":"\\u672a\\u586b\\u5199","DrID":"\\u672a\\u586b\\u5199","IsFrob":"0","RegTime":"2013-10-10 11:32:40","LastTime":"2014-06-17 08:43:24","OrgCount":"0","LinkPhone":"12345","LinkMail":"xirizhifeng@163.com","HospitalName":"dddd","PartmentName":"\\u9009\\u62e9\\u79d1\\u5ba4","Language":"0","RegLevel":"0","LinkAddress":"ces","Interesting":"12","WebInviter":"","IsLogin":"0","Isprotect":"1","LastGpsJing":null,"LastGpsWei":null,"UserType":"0","IsVerification":"0","CanSearch":"0","FuzzySearch":"0","UserImage":"medicool.png","UserSign":"\\u5fc3\\u968f\\u68a6\\u60f3\\uff0c\\u6b7b\\u4ea6\\u4ece\\u5bb9","PhoneIsLogin":"1","gamelocation":"(null)","gamescore":"0","NickName":"\\u6d4b\\u8bd5\\u8d26\\u53f7","SingleID":null,"SingleRemark":null,"PwdSha":"7c4a8d09ca3762af61e59520943dc26494f8941b","userclearpwd":"123456","UserUpdateTime":"2014-05-19 17:07:18"}}', 1);

-- --------------------------------------------------------

--
-- 表的结构 `medi_competence`
--

CREATE TABLE IF NOT EXISTS `medi_competence` (
  `Medi_CompetenceID` int(11) NOT NULL auto_increment COMMENT '权限信息自增ID',
  `Medi_UserID` int(11) default NULL COMMENT '权限用户ID',
  `Medi_VisibleProject` int(11) default NULL COMMENT '可见项目ID',
  PRIMARY KEY  (`Medi_CompetenceID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='权限管理表' AUTO_INCREMENT=6 ;

--
-- 转存表中的数据 `medi_competence`
--

INSERT INTO `medi_competence` (`Medi_CompetenceID`, `Medi_UserID`, `Medi_VisibleProject`) VALUES
(2, 2, 1),
(4, 4, 2),
(5, 5, 22);

-- --------------------------------------------------------

--
-- 表的结构 `medi_domain`
--

CREATE TABLE IF NOT EXISTS `medi_domain` (
  `Medi_DomainID` int(11) NOT NULL auto_increment COMMENT '域名自增ID',
  `Medi_DomainName` varchar(30) default NULL COMMENT '域名地址名称',
  `Medi_InterfaceID` int(11) default NULL COMMENT '所属接口文档ID',
  PRIMARY KEY  (`Medi_DomainID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='域名地址表' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `medi_interface`
--

CREATE TABLE IF NOT EXISTS `medi_interface` (
  `Medi_InterfaceID` int(11) NOT NULL auto_increment COMMENT '接口文档自增ID',
  `Medi_InterfaceName` varchar(100) default NULL COMMENT '接口文档名称',
  `Medi_InterfaceVersion` varchar(50) default NULL COMMENT '接口版本号',
  `Medi_InterfaceCreateName` varchar(50) default NULL COMMENT '接口文档创建人',
  `Medi_InterfaceCreateTime` datetime default NULL COMMENT '接口文档创建时间',
  `Medi_InterfaceUpdateName` varchar(50) default NULL COMMENT '接口文档修改人',
  `Medi_InterfaceUpdateTime` datetime default NULL COMMENT '接口文档修改时间',
  `Medi_ProjectID` int(11) default NULL COMMENT '接口文档所属项目ID',
  PRIMARY KEY  (`Medi_InterfaceID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='接口文档列表' AUTO_INCREMENT=4 ;

--
-- 转存表中的数据 `medi_interface`
--

INSERT INTO `medi_interface` (`Medi_InterfaceID`, `Medi_InterfaceName`, `Medi_InterfaceVersion`, `Medi_InterfaceCreateName`, `Medi_InterfaceCreateTime`, `Medi_InterfaceUpdateName`, `Medi_InterfaceUpdateTime`, `Medi_ProjectID`) VALUES
(1, '珍立拍接口文档', 'V2.0', '刘单风', '2014-05-23 07:18:25', '刘单风', '2014-05-23 07:18:25', 1),
(3, 'MSales接口文档V1.0', 'V1.0', '刘单风', '2014-05-23 14:31:25', '刘单风', '2014-05-23 14:31:25', 2);

-- --------------------------------------------------------

--
-- 表的结构 `medi_project`
--

CREATE TABLE IF NOT EXISTS `medi_project` (
  `Medi_ProjectID` int(11) NOT NULL auto_increment COMMENT '项目自增ID',
  `Medi_ProjectName` varchar(50) default NULL COMMENT '项目名称',
  `Medi_ProjectJoin` varchar(200) default NULL COMMENT '项目参与人',
  `Medi_ProjectInfo` varchar(500) default NULL COMMENT '项目简介',
  PRIMARY KEY  (`Medi_ProjectID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='项目表' AUTO_INCREMENT=23 ;

--
-- 转存表中的数据 `medi_project`
--

INSERT INTO `medi_project` (`Medi_ProjectID`, `Medi_ProjectName`, `Medi_ProjectJoin`, `Medi_ProjectInfo`) VALUES
(1, '珍立拍', '刘单风、谢静', '移动医疗先锋'),
(2, 'Msales', '刘单风、谢静', '市场营销好助手'),
(22, '中国好医生', '刘单风', '发现身边的好医生');

-- --------------------------------------------------------

--
-- 表的结构 `medi_requestparameter`
--

CREATE TABLE IF NOT EXISTS `medi_requestparameter` (
  `Medi_RequestID` int(11) NOT NULL auto_increment COMMENT '请求参数自增ID',
  `Medi_RequestName` varchar(30) default NULL COMMENT '请求参数名称',
  `Medi_RequestType` varchar(50) default NULL COMMENT '请求参数类型',
  `Medi_RequestInfo` varchar(100) NOT NULL COMMENT '请求参数说明',
  `Medi_ParameterType` int(11) default '0' COMMENT '参数类型0是请求参数；1返回具体参数说明',
  `Medi_ApiID` int(11) NOT NULL COMMENT '所属接口ID',
  PRIMARY KEY  (`Medi_RequestID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='接口请求参数表' AUTO_INCREMENT=103 ;

--
-- 转存表中的数据 `medi_requestparameter`
--

INSERT INTO `medi_requestparameter` (`Medi_RequestID`, `Medi_RequestName`, `Medi_RequestType`, `Medi_RequestInfo`, `Medi_ParameterType`, `Medi_ApiID`) VALUES
(10, 'UserName', 'string', '用户名', 0, 1),
(11, 'UserPassword', 'string', '用户密码', 0, 1),
(12, 'user_id', 'int', '用户ID', 1, 1),
(13, 'username', 'string', '用户名', 1, 1),
(14, 'usertoken', 'string', '用户token认证', 1, 1),
(17, 'UserName', 'string', '用户名', 0, 3),
(18, 'UserPassword', 'string', '用户密码', 0, 3),
(19, 'user_id', 'int', '用户ID', 1, 3),
(20, 'username', 'string', '用户名', 1, 3),
(21, 'accessKey', 'string', '七牛密钥ak值', 1, 3),
(22, 'secretKey', 'string', '七牛密钥sk值', 1, 3),
(23, 'usertoken', 'string', '用户唯一token认证', 1, 3),
(24, 'UserName', 'string', '用户名', 0, 2),
(25, 'UserPassword', 'string', '用户密码', 0, 2),
(26, 'phone', 'string', '手机号码', 0, 4),
(37, 'userphone', 'string', '手机号', 0, 5),
(38, 'phonecode', 'string', '验证码', 0, 5),
(39, 'phonepwd', 'string', '用户密码', 0, 5),
(40, 'user_id', 'int', '用户ID', 1, 5),
(41, 'usertoken', 'string', '用户唯一token认证', 1, 5),
(42, 'userid', 'int', '用户ID', 0, 6),
(43, 'userlocation', 'string', '用户所在位置', 0, 6),
(44, 'userscord', 'string', '游戏得分', 0, 6),
(45, 'usercorrect', 'string', '正确率', 0, 6),
(46, 'userdep', 'string', '用户所在科室', 0, 6),
(47, 'usertoken', 'string', '用户唯一token认证', 0, 6),
(48, 'userid', 'type', '用户ID', 0, 7),
(49, 'usertoken', 'string', '用户token唯一认证', 0, 7),
(50, 'UserName', 'string', '用户名', 1, 7),
(51, 'UserScore', 'string', '用户得分', 1, 7),
(52, 'UserLocation', 'string', '所在位置', 1, 7),
(53, 'userid', 'int', '用户ID', 0, 8),
(54, 'useremail', 'string', '用户邮箱', 0, 8),
(55, 'usertype', 'int', '用户类型（0医生；1护士；2医药从业人员；3学生）', 0, 8),
(56, 'userdep', 'string', '用户所在科室', 0, 8),
(57, 'userinterest', 'string', '用户感兴趣专业', 0, 8),
(58, 'usertoken', 'string', '用户唯一token认证', 0, 8),
(59, 'calltype', 'int', '0手机端；1pc端', 0, 8),
(64, 'UserID', 'int', '用户ID', 0, 9),
(65, 'UserPassword', 'string', '用户新密码', 0, 9),
(66, 'usertoken', 'string', '用户token', 0, 9),
(67, 'calltype', 'int', '0手机端，1 pc端', 0, 9),
(68, 'UserName', 'string', '用户名', 0, 10),
(69, 'UserPassword', 'string', '用户密码', 0, 10),
(70, 'UserEmail', 'string', '用户邮箱', 0, 10),
(71, 'usertoken', 'string', '医学网站token认证', 0, 10),
(72, 'UserName', 'string', '用户名', 0, 11),
(73, 'UserPassword', 'string', '用户密码', 0, 11),
(74, 'usertoken', 'string', '医学网站token', 0, 11),
(75, 'username', '用户名', '用户名', 0, 12),
(76, 'userpwd', 'string', '用户密码', 0, 12),
(77, 'usertoken', 'string', '医学网站认证token', 0, 12),
(78, 'userid', 'int', '用户ID', 0, 13),
(79, 'ticklingtype', 'string', '反馈类型', 0, 13),
(80, 'ticklingcontent', 'string', '反馈内容信息', 0, 13),
(81, 'linkemail', 'string', '用户邮箱（可空）', 0, 13),
(82, 'usertoken', 'string', '用户token认证', 0, 13),
(83, 'calltype', 'int', '0手机端，1 pc端', 0, 13),
(84, 'userid', 'int', '用户ID', 0, 14),
(85, 'usertoken', 'string', '用户token', 0, 14),
(86, 'calltype', 'int', '0手机端，1 pc端', 0, 14),
(87, 'userid', 'int', '用户ID', 0, 15),
(88, 'usertoken', 'string', '用户token', 0, 15),
(89, 'calltype', 'int', '0手机端，1 pc端', 0, 15),
(90, 'UserID', 'int', '用户ID', 1, 15),
(91, 'UserName', 'string', '用户名', 1, 15),
(92, 'UserPsw', 'string', '用户密码', 1, 15),
(93, 'FullName', 'string', '用户姓名', 1, 15),
(94, 'PatientCount', 'string', '患者总数', 1, 15),
(95, 'ProjectCount', 'string', '病历总数', 1, 15),
(96, 'RegTime', 'string', '注册时间', 1, 15),
(97, 'LastTime', 'string', '最后登陆时间', 1, 15),
(98, 'LinkPhone', 'string', '联系电话', 1, 15),
(99, 'LinkMail', 'string', '联系邮箱', 1, 15),
(100, 'HospitalName', 'string', '医院名称', 1, 15),
(101, 'PartmentName', 'string', '科室名称', 1, 15),
(102, 'LinkAddress', 'string', '联系地址', 1, 15);

-- --------------------------------------------------------

--
-- 表的结构 `medi_universal`
--

CREATE TABLE IF NOT EXISTS `medi_universal` (
  `Medi_CommonID` int(11) NOT NULL auto_increment COMMENT '返回通用参数自增ID',
  `Medi_CommonName` varchar(100) default NULL COMMENT '返回通用参数名称',
  `Medi_CommonType` varchar(50) default NULL COMMENT '返回通用参数类型',
  `Medi_CommonValue` varchar(100) default NULL COMMENT '返回通用参数的value值',
  `Medi_CommonInfo` varchar(100) default NULL COMMENT '返回通用参数说明',
  `Medi_ApiID` int(11) NOT NULL COMMENT '所属接口ID',
  PRIMARY KEY  (`Medi_CommonID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='接口返回通用数据说明' AUTO_INCREMENT=39 ;

--
-- 转存表中的数据 `medi_universal`
--

INSERT INTO `medi_universal` (`Medi_CommonID`, `Medi_CommonName`, `Medi_CommonType`, `Medi_CommonValue`, `Medi_CommonInfo`, `Medi_ApiID`) VALUES
(5, 'status', 'int', '0/1', '状态码:登录成功/参数不全或登录失败', 1),
(6, 'msg', 'string', '登陆成功/失败或超时/登陆失败', '返回消息内容', 1),
(8, 'status', 'int', '0/1', '返回状态码', 3),
(9, 'msg', 'string', '登陆成功/失败或超时/登陆失败', '返回消息内容', 3),
(10, 'status', 'int', '0/1/2', '注册成功/参数不全或注册失败/用户名已存在', 2),
(11, 'status', 'int', '0/1/2', '发送成功/发送失败/手机号已存在', 4),
(12, 'msg', 'string', 'send success/send failed/telphone exist', '发送成功/发送失败/手机号已存在', 4),
(17, 'status', 'int', '0/1/2/3', '注册成功/参数不全或注册失败/用户名已存在/验证码过期', 5),
(18, 'msg', 'string', 'and insert bone data success/failed/no parameter/duplicate name/code overdue', 'msg消息内容', 5),
(19, 'status', 'int', '0/1/2', '成功/失败or参数不全/token过期', 6),
(20, 'msg', 'string', 'success/failed or no parameter/the token is out of date', '成功/失败or参数不全/token过期', 6),
(21, 'status', 'int', '0/1/2', '成功/失败或参数不全/token过期', 7),
(22, 'msg', 'string', 'success/failed or no parameter/the token is out of date', '成功/失败或参数不全/token过期', 7),
(23, 'status', 'int', '0/1/2', '成功/失败或参数不全/token过期', 8),
(24, 'msg', 'string', 'success/insert failed or no parameter/the token is out of date', '成功/失败或参数不全/token过期', 8),
(25, 'status', 'int', '0/1/2', '成功/失败或参数不全/token过期', 9),
(26, 'msg', 'string', 'success/failed or no parameter/the token is out of date', '成功/失败或参数不全/token过期', 9),
(27, 'status', 'int', '0/1/2', '成功/失败或参数不全/用户已存在', 10),
(28, 'msg', 'string', 'success/failed or no parameter/user cun zai', '成功/失败或参数不全/用户已存在', 10),
(29, 'status', 'int', '1/2', '参数不全/有该账号', 11),
(30, 'msg', 'string', 'no parameter/you', '参数不全/有该账号', 11),
(31, 'status', 'int', '0/1', '成功/参数不全', 12),
(32, 'msg', 'string', 'success/no parameter', '成功/参数不全', 12),
(33, 'status', 'int', '0/1/2', '成功/失败/token过期', 13),
(34, 'msg', 'string', 'success/failed/the token is out of date', '成功/失败/token过期', 13),
(35, 'status', 'int', '0/1', '没过期/过期了或参数不全', 14),
(36, 'msg', 'string', 'success/token overdue or no parameter', '没过期/过期了或参数不全', 14),
(37, 'status', 'int', '0/1/2', '成功/参数不全/token过期', 15),
(38, 'msg', 'string', 'success/no parameter/the token is out of date', '成功/参数不全/token过期', 15);

-- --------------------------------------------------------

--
-- 表的结构 `medi_users`
--

CREATE TABLE IF NOT EXISTS `medi_users` (
  `Medi_UserID` int(11) NOT NULL auto_increment COMMENT '用户ID',
  `Medi_UserName` varchar(30) default NULL COMMENT '用户名',
  `Medi_UserPwd` varchar(100) default NULL COMMENT '用户密码',
  `Medi_TruePwd` varchar(100) default NULL COMMENT '明文密码',
  `Medi_Level` int(11) NOT NULL default '0' COMMENT '用户权限1是有所有权限',
  PRIMARY KEY  (`Medi_UserID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='用户表' AUTO_INCREMENT=8 ;

--
-- 转存表中的数据 `medi_users`
--

INSERT INTO `medi_users` (`Medi_UserID`, `Medi_UserName`, `Medi_UserPwd`, `Medi_TruePwd`, `Medi_Level`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3', 'admin', 1),
(2, 'vividcase', 'ca65caa3174e305ccd4d71e29111adc6', 'vividcase', 0),
(4, 'msales', 'aa05ccafb26558212775e404bb079a23', 'msales', 0),
(5, 'gooddoctor', '080f7fbdb763f621cce9425da60c472b', 'gooddoctor', 0),
(6, '刘单风', 'e10adc3949ba59abbe56e057f20f883e', '123456', 1),
(7, '谢静', 'e10adc3949ba59abbe56e057f20f883e', '123456', 1);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
