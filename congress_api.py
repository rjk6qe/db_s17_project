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


if __name__ == "__main__":
	list_of_members = get_list_of_members()[0]['members']

	print(post_request('api.php', list_of_members))