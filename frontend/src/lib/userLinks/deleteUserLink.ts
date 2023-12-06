export const deleteUserLink = async (id_user_link: string) => {
  const response = await fetch(`http://127.0.0.1:8080/api/users/links/${id_user_link}`, {
    method: 'DELETE'
  })
  const data = await response.json()
  return data
}