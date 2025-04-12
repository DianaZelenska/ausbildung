select id,stadtname,einwohnerzahl from stadt order by einwohnerzahl desc;

select id,stadtname,einwohnerzahl from stadt where id=2;

update stadt set stadtname='Teststadt',einwohnerzahl=300 where id=3;