<?php
class Procurement
{

	//database connection
	private $db;

	/**
	 * Procurement constructor.
	 * @param $db
	 */
	public function __construct($db)
	{
		$this->db = $db;
	}

	public function readAll()
	{
		$this->db->query("SELECT * FROM Procurement WHERE requesterId = :requesterId");
		$this->db->bind(":requesterId", $_SESSION['user']);
		$this->db->execute();
		$rs = $this->db->resultSet();
		return $rs;
	}

	/**
	 * Returns all information about a procurement request with a given id.
	 */
	public function readOne($procurementId)
	{
		/*$query = "SELECT * FROM " . $this->tableName . " WHERE requesterId = :id";
		$this->conn->query($query);
		$this->conn->bind(":id", $procurementId, PDO::PARAM_INT);

		return $this->conn->single();*/

	}

	public function insert($budgetCode, $requesterId, $date, $status, $declineReason, $recurring, $supplierId)
	{
		$this->conn->query("INSERT INTO Procurement (budgetCode, requesterId, date, status, declineReason, recurring, supplierId) VALUES (:budgetCode, :requesterId, :date, :status, :declineReason, :recurring, :supplierId)");
		$this->conn->bind(':budgetCode', $budgetCode);
		$this->conn->bind(':requesterId', $requesterId);
		$this->conn->bind(':date', $date);
		$this->conn->bind(':status', $status);
		$this->conn->bind(':declineReason', $declineReason);
		$this->conn->bind(':recurring', $recurring);
		$this->conn->bind(':supplierId', $supplierId);

		$this->conn->execute();
	}

	public function edit($budgetCode, $requesterId, $date, $status, $declineReason, $recurring, $supplierId, $procurementId)
	{
		$this->conn->query("UPDATE Procurement SET budgetCode=:budgetCode, requesterId=:requesterId, date=:date, status=:status, declineReason=:declineReason, recurring=:recurring, supplierId=:supplierId) WHERE procurementId=:procurementId");
		$this->conn->bind(':budgetCode', $budgetCode);
		$this->conn->bind(':requesterId', $requesterId);
		$this->conn->bind(':date', $date);
		$this->conn->bind(':status', $status);
		$this->conn->bind(':declineReason', $declineReason);
		$this->conn->bind(':recurring', $recurring);
		$this->conn->bind(':supplierId', $supplierId);

		$this->conn->execute();
	}

	public function delete($procurementId)
	{

	}

	public function approve($procurementId)
	{

	}

	public function decline($procurementId)
	{

	}

	public function resubmit($procurementId)
	{

	}
}
?>
