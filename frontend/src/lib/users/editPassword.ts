export const editPassword = async (id_user: string, formData: {
  last_password: string,
  new_password: string,
  repeat_new_password: string
}) => {
  const response = await fetch(`http://localhost:8080/api/users/editPassword/${id_user}`, {
    method: 'PATCH',
    body: JSON.stringify(formData)
  })
  const data = await response.json()
  return data
}