from api_helper import *

def get_list_of_members(congress=None, chamber=None):
	#Congress: 102-114 for House, 80-114 for Senate
	#Chamber: house or senate
	#Default to 114th Senate
	if congress == None:
		congress = 114
	if chamber == None:
		chamber = 'senate'
	return get_request((str(congress),chamber,'members'))

def get_specific_member(member_id=None):
	#Member_id: their own id system
	if member_id != None:
		return get_request(('members',str(member_id)))
	else:
		return None

def get_committees(congress=None, chamber=None):
	return get_request((str(congress),chamber, 'committees'))

def get_current_members_by_district(chamber=None, state=None, district=None):
	#Chamber: house or senate, default to senate
	#State: two-letters, default to VA, duh
	#District, house only
	if chamber==None:
		chamber = "senate"
	if state==None:
		state = "VA"
	if chamber=='house' and district==None:
		district = 1

	if chamber == 'senate':
		return get_request(('members',chamber,state,'current'))
	else:
		return get_request(('members',chamber,state,district,'current'))

def get_members_voting_position(member_id=None):
	#Member_id: their own id system
	if member_id != None:
		return get_request(('members',str(member_id)))
	else:
		return None

def get_specific_roll_call_vote(congress=None, chamber=None, session_number=None, roll_call_number=None):
	#Congress: 102-115 for House, 101-115 for Senate
	#Chamber: house or senate
	#session_number: 1 or 2
	#roll_call_number: integer
	if congress==None:
		congress = 114
	if chamber==None:
		chamber="senate"
	if session_number==None:
		session_number=1
	if roll_call_number==None:
		roll_call_number=1

	return get_request((str(congress), chamber, 'sessions', session_number, 'votes', roll_call_number))


def congressperson_info():
	request_data = {
		'table':'Congressperson', 
		'data':{
			'senate':[],
			'house':[]
			}
		}

	list_of_house_members = get_list_of_members(congress=115, chamber='house')[0]['members']
	list_of_senate_members = get_list_of_members(congress=115, chamber='senate')[0]['members']

	for house_member in list_of_house_members:
		person_info = {
			'first_name': house_member['first_name'], 
			'last_name':house_member['last_name'],
			'district': house_member['district'],
			'state': house_member['state'],
			'party': house_member['party'],
			'type': 'house'
			}
		request_data['data']['house'].append(person_info)

	for senate_member in list_of_senate_members:
		person_info = {
			'first_name': senate_member['first_name'], 
			'last_name':senate_member['last_name'],
			'district': None,
			'state': senate_member['state'],
			'party': senate_member['party'],
			'type': 'senate'
			}
		request_data['data']['senate'].append(person_info)

	return request_data

def committee_info():
	request_data = {
		'table':'Committee', 
		'data':{
			'house_committees':[],
			'senate_committees':[]
			}
		}

	list_of_house_committees = get_committees(congress=115, chamber='house')[0]['committees']
	list_of_senate_committees = get_committees(congress=115, chamber='senate')[0]['committees']

	for committee in list_of_house_committees:
		info = {
			'name':committee['name'],
			'chair':committee['chair']
			}
		request_data['data']['house_committees'].append(info)

	for committee in list_of_senate_committees:
		info = {
			'name':committee['name'],
			'chair':committee['chair']
			}
		request_data['data']['senate_committees'].append(info)

	return request_data

def bill_info():
	request_data = {
		'table':'Bill', 
		'data':{
			'house_committees':[],
			'senate_committees':[]
			}
		}

if __name__ == "__main__":

	