INSERT INTO `ci_sessions` (`session_id`, `ip_address`, `user_agent`, `last_activity`, `user_data`) VALUES ('105e1756fbbfdd92a610981257d96fde', '::1', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/50.0.2661.87 Safari/537.36', 1461682520, '') 
 Execution Time:0.00071883201599121

DELETE FROM `ci_sessions`
WHERE `session_id` =  '105e1756fbbfdd92a610981257d96fde' 
 Execution Time:0.00077605247497559

INSERT INTO `ci_sessions` (`session_id`, `ip_address`, `user_agent`, `last_activity`, `user_data`) VALUES ('5041bbed1e844a456e7b663751f527de', '::1', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/50.0.2661.87 Safari/537.36', 1461682521, '') 
 Execution Time:0.00073790550231934

DELETE FROM `ci_sessions`
WHERE `session_id` =  '5041bbed1e844a456e7b663751f527de' 
 Execution Time:0.00075697898864746

SELECT *
FROM (`ci_sessions`)
WHERE `session_id` =  '00942fb894b78533d99452c2862f994c'
AND `ip_address` =  '::1'
AND `user_agent` =  'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/50.0.2661.87 Safari/537.36' 
 Execution Time:0.00092816352844238

SELECT
												ID,
											  `CODE`,
											  TERM,
											  SY,
											  STATUS
											FROM `t_sy_sem`
											ORDER BY CODE ASC 
 Execution Time:0.038378000259399

SELECT
											  `CODE`,
											  DESCRIPTION,
											  STATUS
											FROM `r_sy` order by STATUS='Present' desc 
 Execution Time:0.016103029251099

SELECT ss.`CODE`, COUNT(DISTINCT se.`STUDENT`) `COUNT` FROM t_sy_sem ss
			LEFT JOIN t_student_enrollment se ON se.`SY_SEM` = ss.`ID`
			WHERE ss.`ID` IN (22)
			GROUP BY ss.ID
			ORDER BY ss.`CODE` 
 Execution Time:0.019855976104736

SELECT s.CODE, COUNT(a.ID) `COUNT` FROM r_sy s
			LEFT JOIN t_applicant a ON LEFT(s.`CODE`, 2) = DATE_FORMAT(a.`DATEAPPLIED`, '%y')	
			WHERE s.`CODE` IN (1213)
			GROUP BY s.CODE
			ORDER BY s.`CODE` 
 Execution Time:0.018584012985229

SELECT *
FROM (`ci_sessions`)
WHERE `session_id` =  '00942fb894b78533d99452c2862f994c'
AND `ip_address` =  '::1'
AND `user_agent` =  'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/50.0.2661.87 Safari/537.36' 
 Execution Time:0.00083398818969727

SELECT
								  ac.`USER_ID`,
								  ac.`FUNCTION_ID`,
								  ac.`ACCESS`
								FROM `u_access_control` ac 
								INNER JOIN u_function f ON f.id = ac.`FUNCTION_ID`
								WHERE ac.`USER_ID` = '25' AND f.`TCODE` = 'ADMIN-0001' 
 Execution Time:0.057816982269287

SELECT *
FROM (`ci_sessions`)
WHERE `session_id` =  '00942fb894b78533d99452c2862f994c'
AND `ip_address` =  '::1'
AND `user_agent` =  'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/50.0.2661.87 Safari/537.36' 
 Execution Time:0.00090813636779785

SELECT
								  ac.`USER_ID`,
								  ac.`FUNCTION_ID`,
								  ac.`ACCESS`
								FROM `u_access_control` ac 
								INNER JOIN u_function f ON f.id = ac.`FUNCTION_ID`
								WHERE ac.`USER_ID` = '25' AND f.`TCODE` = 'ADMIN-0001' 
 Execution Time:0.0015418529510498

SELECT *
FROM (`ci_sessions`)
WHERE `session_id` =  '00942fb894b78533d99452c2862f994c'
AND `ip_address` =  '::1'
AND `user_agent` =  'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/50.0.2661.87 Safari/537.36' 
 Execution Time:0.001007080078125

SELECT
								  ac.`USER_ID`,
								  ac.`FUNCTION_ID`,
								  ac.`ACCESS`
								FROM `u_access_control` ac 
								INNER JOIN u_function f ON f.id = ac.`FUNCTION_ID`
								WHERE ac.`USER_ID` = '25' AND f.`TCODE` = 'ADMIN-0001' 
 Execution Time:0.00193190574646

SELECT *
FROM (`ci_sessions`)
WHERE `session_id` =  '00942fb894b78533d99452c2862f994c'
AND `ip_address` =  '::1'
AND `user_agent` =  'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/50.0.2661.87 Safari/537.36' 
 Execution Time:0.00081086158752441

SELECT
								  ac.`USER_ID`,
								  ac.`FUNCTION_ID`,
								  ac.`ACCESS`
								FROM `u_access_control` ac 
								INNER JOIN u_function f ON f.id = ac.`FUNCTION_ID`
								WHERE ac.`USER_ID` = '25' AND f.`TCODE` = 'ADMIN-0001' 
 Execution Time:0.0014710426330566

