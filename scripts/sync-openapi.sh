#!/usr/bin/env bash
set -euo pipefail

ROOT="$(cd "$(dirname "${BASH_SOURCE[0]}")/.." && pwd)"
SPEC_URL="https://raw.githubusercontent.com/contabo/cntb/master/openapi/api/openapi.yaml"
TARGET="${ROOT}/openapi/openapi.yaml"

mkdir -p "${ROOT}/openapi"

echo "Descargando OpenAPI oficial desde contabo/cntb..."
curl -fsSL "${SPEC_URL}" -o "${TARGET}.tmp"
mv "${TARGET}.tmp" "${TARGET}"

PATH_COUNT=$(grep -c '^  /v1/' "${TARGET}" || true)
OP_COUNT=$(grep -cE '^    (get|post|put|patch|delete):' "${TARGET}" || true)
VERSION=$(grep '^  version:' "${TARGET}" | awk '{print $2}')

echo "Spec sincronizada: version=${VERSION}, paths=${PATH_COUNT}, operations=${OP_COUNT}"
echo "Archivo: ${TARGET}"
