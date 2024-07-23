script_dir=$(dirname "$0")
docker build -t test-db "$script_dir/.."
container_id=$(docker run -d -p 3999:3306 --name test-db test-db)
docker wait "$container_id"
echo "container up"