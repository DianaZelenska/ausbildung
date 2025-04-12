select id, autorid, datum, inhalt from beitrag order by datum desc limit 10;

select id,vorname from autor where id=3 limit 1;

insert into beitrag(autorid,inhalt) values(1, 'Tralala');