<?php

namespace FRI\LDAP;

class Ldap
{

    var $name = 'User';
    var $primaryKey = 'uid';
    var $account_suffix = "@fri.uniza.sk";
    var $host = 'fri.uniza.sk';
    var $port = 389;
    var $baseDn = 'DC=fri,DC=uniza,DC=sk';
    var $user = 'publikacna_cinnost';
    var $pass = "kacka789";
    var $ds;
    var $ldapFieldsToFind = ["cn", "uid", "uidnumber", "employeenumber",
        "gidnumber", "givenname", "sn", "displayname", "physicaldeliveryofficename",
        "distinguishedname", "telephonenumber", "roomnumber", "gecos", "labeleduri", "roleoccupant", "description", 'memberof', 'userAccountControl'];

    function __construct()
    {

        $this->ds = ldap_connect($this->host, $this->port);

        ldap_set_option($this->ds, LDAP_OPT_PROTOCOL_VERSION, 3);
        ldap_set_option($this->ds, LDAP_OPT_REFERRALS, 0);
        ldap_bind($this->ds, $this->user, $this->pass);
    }

    function __destruct()
    {
        ldap_close($this->ds);
    }

    function findTeachers($value = '*', $baseDn = 'DC=fri,DC=uniza,DC=sk')
    {
        $filter = "(&(gidnumber=14004)(|(uidnumber=$value)(cn=*$value*)(sn=$value*)))";
        $r = @ldap_search($this->ds, $baseDn, $filter, $this->ldapFieldsToFind);
        if ($r) {
            ldap_sort($this->ds, $r, "sn");
            $result = ldap_get_entries($this->ds, $r);
            return $this->convert_from_ldap($result);
        }
        return null;
    }

    function findStudent($value = '*', $baseDn = 'DC=fri,DC=uniza,DC=sk')
    {
        $filter = "(&(gidnumber=14005)(|(uidnumber=$value)(cn=*$value*)(sn=$value*)))";
        $r = @ldap_search($this->ds, $baseDn, $filter, $this->ldapFieldsToFind);
        if ($r) {
            ldap_sort($this->ds, $r, "sn");
            $result = ldap_get_entries($this->ds, $r);
            //return $result;
            return $this->convert_from_ldap($result);
        }
        return null;
    }

    function findAll($attribute = 'uid', $value = '*', $baseDn = 'OU=People,DC=fri,DC=uniza,DC=sk')
    {
        $r = ldap_search($this->ds, $baseDn, $attribute . '=' . $value, $this->ldapFieldsToFind);
        if ($r) {
            ldap_sort($this->ds, $r, "sn");

            $result = ldap_get_entries($this->ds, $r);
            return $this->convert_from_ldap($result);
        }
        return null;
    }

    //podla lubovolnej skupiny
    function findByGroup($value, $baseDn = 'DC=fri,DC=uniza,DC=sk')
    {
        $filter = "(memberOf=CN=$value,OU=Groups,$baseDn)";
        $r = ldap_search($this->ds, $baseDn, $filter, $this->ldapFieldsToFind);
        if ($r) {
            ldap_sort($this->ds, $r, "sn");
            $result = ldap_get_entries($this->ds, $r);
            //return $result;
            $data = $this->convert_from_ldap($result);
            return $data;
        }
        return null;
    }

    function findBy($filter, $baseDn = 'DC=fri,DC=uniza,DC=sk')
    {
        $r = ldap_search($this->ds, $baseDn, $filter, $this->ldapFieldsToFind);
        if ($r) {
            ldap_sort($this->ds, $r, "sn");
            $result = ldap_get_entries($this->ds, $r);
            //return $result;
            return $this->convert_from_ldap($result);
        }
        return null;
    }

    function getPracoviskoOccupantsData($value, $baseDn = 'DC=fri,DC=uniza,DC=sk')
    {
        $filter = "(CN=*)";
        $r = ldap_search($this->ds, "OU=$value,OU=Pracoviska," . $baseDn, $filter, $this->ldapFieldsToFind);
        $pozicie = ldap_get_entries($this->ds, $r);
        $data = [];

        for ($i = 0; $i <= $pozicie['count'] - 1; $i++) {
            $cn = $pozicie[$i]['cn'][0];

            if(isset($pozicie[$i]['roleoccupant'])) {
                for ($j = 0; $j <= $pozicie[$i]['roleoccupant']['count'] - 1; $j++) {
                    $filter = "sn=*";
                    $r = ldap_search($this->ds, $pozicie[$i]['roleoccupant'][$j], $filter);
                    $entries = ldap_get_entries($this->ds, $r);
                    $data[$cn]['uid'][] = $entries[0]['uid'][0];
                    $data[$cn]['phone'][] = isset($entries[0]['telephonenumber'][0]) ? $entries[0]['telephonenumber'][0] : NULL;
                }
            }
        }

        return $data;
    }

    public function getPracoviskoPhoneNumber($departmentCode, $field, $baseDn = 'DC=fri,DC=uniza,DC=sk')
    {
        $filter = '(CN=' . $field . ')';
        $r = ldap_search($this->ds, "OU=${departmentCode},OU=Pracoviska," . $baseDn, $filter, $this->ldapFieldsToFind);
        $data = ldap_get_entries($this->ds, $r);

        if (isset($data[0]['telephonenumber'][0])) {
            return $data[0]['telephonenumber'][0];
        } else {
            return NULL;
        }
    }

    public function getPracoviskoRoleRoom($departmentCode, $roleCode, $baseDn = 'DC=fri,DC=uniza,DC=sk')
    {
        $filter = '(CN=' . $roleCode . ')';
        $r = ldap_search($this->ds, "OU=${departmentCode},OU=Pracoviska," . $baseDn, $filter, $this->ldapFieldsToFind);
        $data = ldap_get_entries($this->ds, $r);

        if (isset($data[0]['physicaldeliveryofficename'][0])) {
            return $data[0]['physicaldeliveryofficename'][0];
        } else {
            return NULL;
        }
    }

    function getPracoviskoData($value = '*', $baseDn = 'DC=fri,DC=uniza,DC=sk')
    {
        $filter = "(OU=$value)";
        $r = ldap_search($this->ds, "OU=Pracoviska," . $baseDn, $filter);
        $data = ldap_get_entries($this->ds, $r);

        return $this->convert_from_ldap($data);
    }

//-------------------------------------------------------------------------
//Vracia udaje pre danu katedru - veduceho,zastupcu,sekretarku a clenov
//value pre skratku katedry
	function get_KatedraData($value, $baseDn = 'DC=fri,DC=uniza,DC=sk')
	{

		$filter = "(&(memberOf=CN=$value,OU=Groups,$baseDn)(!(memberof=CN=doktorandi,OU=Groups,$baseDn)))";
		$data = $this->findBy($filter, $baseDn);

		$filter = "(&(memberOf=CN=$value,OU=Groups,$baseDn)(memberof=CN=veduci,OU=Groups,$baseDn))";
		$result = $this->findBy($filter, $baseDn);
		$data['veduci'] = $result[0]['LdapUser'];

		$filter = "(&(memberOf=CN=$value,OU=Groups,$baseDn)(memberof=CN=sekretarky,OU=Groups,$baseDn))";
		$result = $this->findBy($filter, $baseDn);
		$data['sekretariat'] = $result[0]['LdapUser'];

		$filter = "(&(memberOf=CN=$value,OU=Groups,$baseDn)(memberof=CN=zastupcovia_kat,OU=Groups,$baseDn))";
		$result = $this->findBy($filter, $baseDn);
		$data['zastupca'] = $result[0]['LdapUser'];

		$filter = "(&(memberOf=CN=$value,OU=Groups,$baseDn)(memberof=CN=doktorandi,OU=Groups,$baseDn))";
		$result = $this->findBy($filter, $baseDn);
		$data['doktorandi'] = $result;

		return $data;
		;
	}

//---------------------------------------------------------------------------

	function read($fields = null, $uid)
	{
		$r = ldap_search($this->ds, $this->baseDn, 'uid=' . $uid);
		if ($r)
		{
			$l = ldap_get_entries($this->ds, $r);
			$convert = $this->convert_from_ldap($l);
			return $convert[0];
		}
	}

	function auth($uid, $password)
	{
		if ($uid == NULL || $password == NULL)
			return (false);
		$result = $this->findAll('uid', $uid);

		if ($result[0])
		{
			if (@ldap_bind($this->ds, $uid . $this->account_suffix, $password))
			{
				return true;
			}
			else
			{
				return false;
			}
		}
		else
		{
			return false;
		}
	}

	private function convert_from_ldap($data)
	{
		$final = null;

		foreach ($data as $key => $row):
			if ($key === 'count')
				continue;

			foreach ($row as $key1 => $param):

				if (!is_numeric($key1))
					continue;
				if ($row[$param]['count'] === 1)
					$final[$key]['LdapUser'][$param] = $row[$param][0];
				else
				{
					foreach ($row[$param] as $key2 => $item):
						if ($key2 === 'count')
							continue;
						$final[$key]['LdapUser'][$param][] = $item;
					endforeach;
				}
			endforeach;

			// extract group names
			if (!isset($final[$key]['LdapUser']['memberof']) || !is_array($final[$key]['LdapUser']['memberof']))
				continue;

			foreach ($final[$key]['LdapUser']['memberof'] as &$val)
			{
				$matches = \Nette\Utils\Strings::match($val, '/CN=(.*),/U');
				$val = $matches[1];
			}
		endforeach;

		return $final;
	}

	private function explode_dn($dn, $with_attributes = 0)
	{
		$result = ldap_explode_dn($dn, $with_attributes);
		//translate hex code into ascii again
		foreach ($result as $key => $value)
			$result[$key] = preg_replace("/\\\([0-9A-Fa-f]{2})/e", "''.chr(hexdec('\\1')).''", $value);
		return $result;
	}

//jednoduchy array mien clenov skupiny
	function get_members($group, $baseDn = 'DC=fri,DC=uniza,DC=sk')
	{
		$results = ldap_search($this->ds, $baseDn, "cn=" . $group);
		$entries = ldap_get_entries($this->ds, $results);

		$dirty = 0;

		// build array of members for this group, first item is count - skipped using $dirty
		foreach ($entries[0]['member'] as $member)
		{
			if ($dirty == 0)
			{
				$dirty = 1;
			}
			else
			{
				$member_dets = $this->explode_dn($member);
				$members[] = str_replace("CN=", "", $member_dets[0]);
			}
		}

		return $members;
	}
}
