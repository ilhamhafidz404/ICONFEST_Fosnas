import axios from "axios";

export async function TaskGet(
	schoolId = 0,
	search= "",
	paginate= "1",
	page= 1,
  userId= 0,
) {
  try {
    let result = await axios.get(`
    	http://127.0.0.1:8000/api/tasks?school=${schoolId}&search=${search}&paginate=${paginate}&page=${page}&user=${userId}
    `);
    if (result) {
      return result;
    }
  } catch (error) {
    console.error(error);
    throw error;
  }
}