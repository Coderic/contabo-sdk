#!/usr/bin/env bash
set -euo pipefail

ROOT="$(cd "$(dirname "${BASH_SOURCE[0]}")/.." && pwd)"
SPEC="${ROOT}/openapi/openapi.yaml"
OUT="${ROOT}/src/Generated"
JAR="${ROOT}/openapi-generator-cli.jar"

if [[ ! -f "${SPEC}" ]]; then
  echo "No existe ${SPEC}. Ejecuta: composer sync-openapi"
  exit 1
fi

if [[ ! -f "${JAR}" ]]; then
  echo "Descargando openapi-generator-cli..."
  curl -fsSL "https://repo1.maven.org/maven2/org/openapitools/openapi-generator-cli/7.12.0/openapi-generator-cli-7.12.0.jar" -o "${JAR}"
fi

rm -rf "${OUT}"
mkdir -p "${OUT}"

echo "Generando cliente PHP..."
java -jar "${JAR}" generate \
  -i "${SPEC}" \
  -g php \
  -o "${OUT}" \
  --additional-properties=invokerPackage=Coderic\\Contabo\\Generated,variableNamingConvention=camelCase,packageName=contabo-sdk

echo "Cliente generado en ${OUT}"
