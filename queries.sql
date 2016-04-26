/*



*/

select * from users;

SELECT * FROM users WHERE email = 'jeff@hedfors.net';

insert into users (name, alias, email, password, dob, created_at, modified_at) values('Jayden Hedfors','jayden','jayden@hedfors.net','a642a77abd7d4f51bf9226ceaf891fcbb5b299b8','1967/11/30',NOW(),NOW());

-- poke a person
SELECT * FROM pokes;
-- poke a person
SELECT count  FROM pokes
WHERE pokee_id = 6 AND poker_id = 1;

-- poke a person
insert into pokes (poker_id, pokee_id, count, created_at, modified_at) values(8,8,0,NOW(),NOW());

SELECT poker_id, r.name as poker_name, pokee_id, e.name as pokee_name, count from pokes
left join users r on r.id = pokes.poker_id
left join users e on e.id = pokes.pokee_id;

SELECT SUM(count) as pokes_recieved, pokee_id FROM pokes
WHERE pokee_id = 6;

SELECT users.id, name, alias, email, SUM(count) as pokes_recieved FROM users
LEFT JOIN pokes ON users.id = pokee_id;

SELECT poker_id, users.name as pokee_name, pokee_id  from pokes
left join users on users.id = pokee_id;

select users.name from users where id=5;




insert into users (name) values ("jeff");
select * from users;

insert into pokes (poker_id, pokee_id) values (5,6);
select * from pokes;

