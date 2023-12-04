export const editUser = async (id_user: string, formData: {
  username: string,
  email: string,
  display_name: string,
}) => {
  const response = await fetch(`http://localhost:8080/api/users/${id_user}`, {
    method: 'PATCH',
    body: JSON.stringify(formData)
  })
  const data = await response.json()
  return data
}