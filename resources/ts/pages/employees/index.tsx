import { Button, Dropdown, DropdownDivider, DropdownItem, Label, Table, TableBody, TableCell, TableHead, TableHeadCell, TableRow, TextInput } from "flowbite-react"

interface Employee {
  id: number;
  nama_lengkap: string;
  email: string;
  nomor_telepon: string;
}

export default function EmployeesPage() {
  return (
    <div className="container mt-5">
      <div className="mb-3" style={{ display: 'flex', justifyContent: 'space-between', alignItems: 'center', gap: '1rem', flexWrap: 'wrap' }}>
        <h1 className="text-4xl font-bold">Daftar Pegawai</h1>
      </div>
      <div className="flex flex-col md:flex-row items-center justify-between space-y-3 md:space-y-0 md:space-x-4 p-4">
        <div className="w-full md:w-1/2">
          <form className="flex items-center" action="" method="GET">
            <Label htmlFor="search" className="sr-only">Search</Label>
            <div className="relative w-full">
              <TextInput type="search" id="employee-search" name="search" placeholder="Cari pegawai" icon={() => (
                <svg aria-hidden="true" className="w-5 h-5 text-gray-500 dark:text-gray-400" fill="currentColor"
                  viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                  <path fillRule="evenodd"
                    d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                    clipRule="evenodd" />
                </svg>
              )} />
            </div>
          </form>
        </div>
        <div className="w-full md:w-auto flex flex-col md:flex-row space-y-2 md:space-y-0 items-stretch md:items-center justify-end md:space-x-3 shrink-0">
          <Button>
            <svg className="h-3.5 w-3.5 mr-2" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"
              aria-hidden="true">
              <path clipRule="evenodd" fillRule="evenodd"
                d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" />
            </svg>
            Tambah Pegawai
          </Button>
          <Dropdown label="Filter" inline>
            <DropdownItem></DropdownItem>
            <DropdownItem></DropdownItem>
            <DropdownDivider />
            <DropdownItem></DropdownItem>
          </Dropdown>
        </div>
      </div>
      <div className="overflow-x-auto">
        <Table>
          <TableHead>
            <TableRow>
              <TableHeadCell>Product name</TableHeadCell>
              <TableHeadCell>Color</TableHeadCell>
              <TableHeadCell>Category</TableHeadCell>
              <TableHeadCell>Price</TableHeadCell>
              <TableHeadCell>
                <span className="sr-only">Edit</span>
              </TableHeadCell>
            </TableRow>
          </TableHead>
          <TableBody className="divide-y">
            <TableRow className="bg-white dark:border-gray-700 dark:bg-gray-800">
              <TableCell className="whitespace-nowrap font-medium text-gray-900 dark:text-white">
                Apple MacBook Pro 17"
              </TableCell>
              <TableCell>Sliver</TableCell>
              <TableCell>Laptop</TableCell>
              <TableCell>$2999</TableCell>
              <TableCell>
                <Dropdown label="" inline renderTrigger={() => (
                  <svg className="w-5 h-5" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20"
                    xmlns="http://www.w3.org/2000/svg">
                    <path
                      d="M6 10a2 2 0 11-4 0 2 2 0 014 0zM12 10a2 2 0 11-4 0 2 2 0 014 0zM16 12a2 2 0 100-4 2 2 0 000 4z" />
                  </svg>
                )}>
                  <DropdownItem>Show</DropdownItem>
                  <DropdownItem>Edit</DropdownItem>
                  <DropdownDivider />
                  <DropdownItem>Delete</DropdownItem>
                </Dropdown>
              </TableCell>
            </TableRow>
            <TableRow className="bg-white dark:border-gray-700 dark:bg-gray-800">
              <TableCell className="whitespace-nowrap font-medium text-gray-900 dark:text-white">
                Microsoft Surface Pro
              </TableCell>
              <TableCell>White</TableCell>
              <TableCell>Laptop PC</TableCell>
              <TableCell>$1999</TableCell>
              <TableCell>
                <a href="#" className="font-medium text-primary-600 hover:underline dark:text-primary-500">
                  Edit
                </a>
              </TableCell>
            </TableRow>
            <TableRow className="bg-white dark:border-gray-700 dark:bg-gray-800">
              <TableCell className="whitespace-nowrap font-medium text-gray-900 dark:text-white">Magic Mouse 2</TableCell>
              <TableCell>Black</TableCell>
              <TableCell>Accessories</TableCell>
              <TableCell>$99</TableCell>
              <TableCell>
                <a href="#" className="font-medium text-primary-600 hover:underline dark:text-primary-500">
                  Edit
                </a>
              </TableCell>
            </TableRow>
          </TableBody>
        </Table>
      </div>
    </div>
  );
}