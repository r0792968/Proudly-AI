key = "056OL29RRtKkfikDIAslL7lytVsODwK3Z5xLsoTDy7Q"
id = '864520330260797'
name = "Proudly"
adress = 'https://www.linkedin.com/sales/search/company?query=(filters%3AList((type%3AANNUAL_REVENUE%2CrangeValue%3A(min%3A1%2Cmax%3A100)%2CselectedSubFilter%3AUSD)%2C(type%3ACOMPANY_HEADCOUNT%2Cvalues%3AList((id%3AD%2Ctext%3A51-200%2CselectionType%3AINCLUDED)))))&sessionId=LFGMh86aSfic4RnHsrulRQ%3D%3D&viewAllFilters=true'

//update(adress,id,name,key);
//launch(key,id);
let json = JSON.stringify(fetcher(id,key));

function update(adress,id,name,key){
    const options = {
        method: 'POST',
        headers: {
          accept: 'application/json',
          'content-type': 'application/json',
          'X-Phantombuster-Key': key
        },
        body: JSON.stringify({
          id: id,
          name: name,
          proxyAddress: adress
        })
      };
      
      fetch('https://api.phantombuster.com/api/v2/agents/save', options)
        .then(response => response.json())
        .then(response => console.log(response))
        .catch(err => console.error(err));
}
function launch(key,id){
    const options = {
        method: 'POST',
        headers: {
          'content-type': 'application/json',
          'X-Phantombuster-Key': key
        },
        body: JSON.stringify({id: id})
      };
      
      fetch('https://api.phantombuster.com/api/v2/agents/launch', options)
        .then(response => response.json())
        .then(response => console.log(response))
        .catch(err => console.error(err));
}
function fetcher(id,key){
    const options = {
        method: 'GET',
        headers: {
          accept: 'application/json',
          'X-Phantombuster-Key': key
        }
      };
      
      fetch('https://api.phantombuster.com/api/v2/agents/fetch?id='+id, options)
        .then(response => response.json())
        .then(response => console.log(response))
        .catch(err => console.error(err));
    return file
}


console.log(fetcher(id,key))