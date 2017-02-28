import requests
import json

_BASE_URL = "https://api.propublica.org/congress"
_VERSION = "v1"
_API_KEY = "izwsxGrduEFCdnoc0n3laYJRQSlWlnN7rTU8vJOj"
_API_BASE_URL = '/'.join((_BASE_URL, _VERSION))
_HEADERS = {"X-API-Key": _API_KEY, "Content-Type":"application/json"}

_PHP_URL = "http://plato.cs.virginia.edu"
_UVA_ID = "rjk6qe"
_TILDE_ID = ''.join(('~',_UVA_ID))
_STARDOCK_URL = "/".join((_PHP_URL, _TILDE_ID))

def get_request(tuple_of_url_elements):
	#to go to api/v1/hey/you/there.json, pass ('hey','you',there')
	#returns dictionary or None, depending on status

	def _join_url(params):
		join_params = "/".join(params)
		url_without_dot_json = "/".join((_API_BASE_URL, join_params))
		return ''.join((url_without_dot_json, '.json'))

	url = _join_url(tuple_of_url_elements)
	response = requests.get(url, headers=_HEADERS).json()
	if response['status'] == 'OK':
		return response['results']
	else:
		return None


def post_request(script, data):
	#send to whatever script we need
	#returns response if valid, None otherwise

	def _join_url(params):
		join_params = "/".join(params)
		return "/".join((_STARDOCK_URL, join_params))

	url = _join_url((script,))
	response = requests.post(url, data=json.dumps(data), headers=_HEADERS)

	return response.text