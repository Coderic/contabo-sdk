#!/usr/bin/env bash
set -euo pipefail

ROOT="$(cd "$(dirname "${BASH_SOURCE[0]}")/.." && pwd)"
LOCAL="${ROOT}/openapi/openapi.yaml"
REMOTE_URL="https://raw.githubusercontent.com/contabo/cntb/master/openapi/api/openapi.yaml"
REMOTE_TMP="$(mktemp)"

curl -fsSL "${REMOTE_URL}" -o "${REMOTE_TMP}"

if [[ ! -f "${LOCAL}" ]]; then
  echo "No hay spec local. Ejecuta composer sync-openapi primero."
  rm -f "${REMOTE_TMP}"
  exit 1
fi

if diff -q "${LOCAL}" "${REMOTE_TMP}" >/dev/null 2>&1; then
  echo "openapi/openapi.yaml esta sincronizada con contabo/cntb."
else
  echo "ADVERTENCIA: openapi/openapi.yaml difiere de contabo/cntb."
  diff -u "${LOCAL}" "${REMOTE_TMP}" | head -50 || true
  exit 1
fi

rm -f "${REMOTE_TMP}"
