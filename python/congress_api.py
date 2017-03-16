from api_helper import *

def get_list_of_members(congress=None, chamber=None):
	#Params: congress and chamber
	return get_request((str(congress),chamber,'members'))

def get_specific_member(member_id=None):
	#Params: member_id
	return get_request(('members',str(member_id)))

def get_committees(congress=None, chamber=None):
	#Params: congress and chamber
	return get_request((str(congress),chamber, 'committees'))

def get_current_members_by_district(chamber=None, state=None, district=None):
	if chamber == 'senate':
		return get_request(('members',chamber,state,'current'))
	else:
		return get_request(('members',chamber,state,district,'current'))

def get_members_voting_position(member_id=None):
	#Params: member_id
	return get_request(('members',str(member_id)))

def get_specific_roll_call_vote(congress=None, chamber=None, session_number=None, roll_call_number=None):
	#Parms: congress, chamber, session_number, roll_call_number
	return get_request((str(congress), chamber, 'sessions', str(session_number), 'votes', str(roll_call_number)))

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
			'member_id':house_member['id'],
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
			'member_id':house_member['id'],
			'first_name': senate_member['first_name'], 
			'last_name':senate_member['last_name'],
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
			'chair':committee['chair'],
			'chair_id':committee['chair_id']
			}
		request_data['data']['house_committees'].append(info)

	for committee in list_of_senate_committees:
		info = {
			'name':committee['name'],
			'chair':committee['chair'],
			'chair_id':committee['chair_id']
			}
		request_data['data']['senate_committees'].append(info)

	return request_data

def bill_info():
	request_data = {
		'table':'Bill', 
		'data':{
			'house_votes':[],
			'senate_votes':[]
			}
		}

	bill_dict = {}

	for roll_call_number in range(1, 10):
		vote = get_specific_roll_call_vote(congress=115, chamber='senate', session_number=1, roll_call_number=roll_call_number)['votes']['vote']
		if 'bill' in vote.keys():
			bill_info = get_request((None,), url=vote['bill']['api_uri'])[0]
			sponsor_info = get_request((None,), url=bill_info['sponsor_uri'])[0]
			bill_dict['committee'] = bill_info['committees']
			bill_dict['bill_id'] = bill_info['bill']
			bill_dict['bill_title'] = vote['bill']['title']
			bill_dict['bill_sponsor_id'] = sponsor_info['member_id']
			request_data['data']['house_votes'].append(bill_dict)
	return request_data
	


if __name__ == "__main__":
	#post_request('db_s17_project/project/bill_api.php', bill_info())
	# print("Committees:")
	# print(post_request('db_s17_project/project/committee_api.php', committee_info()))
	# print()
	# print()
	print(post_request('db_s17_project/project/congressperson_api.php', committee_info()))

