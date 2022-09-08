FROM postgres:13.1-alpine

ARG POSTGRES_DB
ARG POSTGRES_USER
ARG POSTGRES_PASSWORD
ARG PG_PORT

COPY ./docker/postgres/init.sh /docker-entry-point-initdb.sh/

USER postgres

CMD ["postgres"]

EXPOSE $PG_PORT