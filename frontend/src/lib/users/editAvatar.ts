export const editAvatar = async (id_user: string, formData: FormData) => {
  const reponse = await fetch(`http://localhost:8080/api/users/editAvatar/${id_user}`, {
    method: 'POST',
    body: formData
  })
  const data = await reponse.json()
  return data
}