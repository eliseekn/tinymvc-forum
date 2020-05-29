//send HTTP post request using fetch api
async function postRequest(url, data = null) {
	const request = await fetch(url, {
		method: 'post',
		body: data
	})

	try {
		const response = await request.json()
		return response
	} catch(error) {
		//console.log(error)
	}
}

//send HTTP get request using fetch api
async function getRequest(url, data = null) {
	const request = await fetch(url, {
		method: 'get',
		body: data
	})

	try {
		const response = await request.json()
		return response
	} catch(error) {
		//console.log(error)
	}
}