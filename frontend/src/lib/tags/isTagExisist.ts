async function isTagExist(name:string) {
  const response = await fetch(`http://127.0.0.1:8080/api/tags/check`);
  const data = await response.json();
  return data;
}