export const upvote = async (id_project: string, id_user: string) => {
  const response = await fetch('http://127.0.0.1:8080/api/upvotes', {
    method: 'POST',
    body: JSON.stringify({
      id_project,
      id_user
    })
  })
  const data = await response.json()
  
  return data
}