export const newUserLink = async (link: string, id_user: string) => {
  const response = await fetch(`http://127.0.0.1:8080/api/users/links`, {
    method: 'POST',
    body: JSON.stringify({ link, id_user }),
  })
  const data = await response.json()
  return data
}