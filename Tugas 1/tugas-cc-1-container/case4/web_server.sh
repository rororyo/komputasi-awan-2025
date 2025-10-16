
#!/bin/sh
docker rm -f webserver1
docker run -dit \
  --name webserver1 \
  -v $(pwd)/files:/data \
  -p 9999:9999 \
  python:3.13.0a1-alpine3.17 \
  python3 -m http.server 9999 -d /data

