select * from quotes;
select * from users;
select * from favorites;

INSERT INTO quotes (user_id, speaker, quote, created_at, modified_at) VALUES('1','Douglas Adams','So long, and thanks for all the fish!', NOW(),NOW());
INSERT INTO quotes (user_id, speaker, quote, created_at, modified_at) VALUES('1','Douasdfdams','Sasdfasdffor all the fish!', NOW(),NOW());
INSERT INTO quotes (user_id, speaker, quote, created_at, modified_at) VALUES('1','Douasds Adams','So long, andasdfasdf all the fish!', NOW(),NOW());
INSERT INTO quotes (user_id, speaker, quote, created_at, modified_at) VALUES('1','Douglas asdf','So as, andasdfthanks for all the fish!', NOW(),NOW());

-- all
select quotes.user_id, users.name as user_name, speaker, quote, quotes.created_at  from quotes
LEFT JOIN users ON users.id = quotes.user_id
LEFT JOIN favorites on favorites.quote_id = quotes.id;

--  in favorites	
select quotes.id as quote_id,quotes.user_id as poster_id, users.name as user_name, speaker, quote, quotes.created_at  from quotes
LEFT JOIN users ON users.id = quotes.user_id
LEFT JOIN favorites on favorites.quote_id = quotes.id
WHERE favorites.user_id = 1 ;

SELECT quote_id from favorites
where user_id = 1;

insert into favorites (user_id, quote_id) VALUES (1,2);

-- all but not in
select quotes.id as quote_id,quotes.user_id as poster_id, users.name as user_name, speaker, quote, quotes.created_at  from quotes
LEFT JOIN users ON users.id = quotes.user_id
WHERE NOT quotes.id in(select quotes.id from quotes
LEFT JOIN users ON users.id = quotes.user_id
LEFT JOIN favorites on favorites.quote_id = quotes.id
WHERE favorites.user_id = 1);


select quotes.id as quote_id,quotes.user_id, users.name as user_name, speaker, quote, quotes.created_at  from quotes
LEFT JOIN users ON users.id = quotes.user_id
LEFT JOIN favorites on favorites.quote_id = quotes.id
WHERE NOT quotes.id in(select quotes.id from quotes
LEFT JOIN users ON users.id = quotes.user_id
LEFT JOIN favorites on favorites.quote_id = quotes.id
WHERE favorites.user_id = 1);

 



SELECT * FROM trips
left join users
on users.id = trip_creator_id
where not trips.id in (SELECT trips.id FROM trips
left JOIN user_trips
ON user_trips.trips_id = trips.id
left JOIN users
ON user_trips.users_id = users.id
where users.id = 1);




SELECT quotes.id as quote_id, quotes.user_id, favorites. id as favorite_id, users.alias as alias, speaker, quote, quotes.created_at  from quotes
			LEFT JOIN users ON users.id = quotes.user_id
			LEFT JOIN favorites on favorites.quote_id = quotes.id